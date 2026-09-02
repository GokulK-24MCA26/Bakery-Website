# Bakery — Project Analysis (≤200 lines)

## 1. About the Project
Bakery is a Laravel 13 (PHP 8.3) full-stack e-commerce app for an online bakery shop on Laragon/Windows + SQLite. Customers browse products by category, view gallery, place orders and contact shop; admins (role:admin) manage categories/products/gallery/orders/contacts via dashboard. Frontend: Blade + Tailwind CSS v4 + Vite 8 + vanilla JS.

> Stack: Laravel 13, Eloquent ORM, SQLite, Blade, Tailwind v4, Vite 8, Composer, NPM, PHPUnit 12, Pint, Pail
> Entry: `routes/web.php:16`, Controllers: `app/Http/Controllers/`, Models: `app/Models/`

## 2. Architecture (MVC)
- **Models** `app/Models/` — User, categories, Product, Gallery, Order, Contact, ContactDetail
- **Controllers** `app/Http/Controllers/` — Home, Auth, Categories, Products, Gallery, Order, Contact, Layout
- **Views** `resources/views/` — layouts/app, home/*, products/* (cakes/cupcakes/cookies/breads/donuts-desserts/index), gallery, orders, admin/*, contact, about, auth
- **Routes** `routes/web.php:1-82` — public, auth, admin groups (middleware `role:admin`)
- **Migrations** `database/migrations/` — users, categories, products, gallery, orders, contacts, contact_details
- **Middleware** `app/Http/Middleware/Rolemiddleware.php` — role guard

## 3. Key Routes
Public: `/` `HomeController@index:9`, `/cakes|/cupcakes|/cookies|/breads|/donuts-desserts`, `/products` `HomeController@allProducts:48`, `/about`, `/contact`, `/gallery` `GalleryController@publicIndex:92`, `/login|/register`
Auth: `/order/{product}` `OrderController@create:43`, POST `/order` `store:48`, `/my-orders` `myOrders:75`
Admin (`prefix admin + role:admin`): `/admin/dashboard` `routes/web.php:60` (stats closure), `resource categories/products/gallery`, `/admin/orders` + `/admin/contacts*`

## 4. Data Model & Relationships
- `User 1—N Order` , `Product 1—N Order` , `categories 1—N Product` `Product@category:11`, `Product@orders:15`, `Order@user/product:11-12`
- `Product: category_id, name, description, price decimal(8,2), image`
- `Order: user_id, product_id, quantity int, price decimal(10,2), total_price decimal(10,2), status enum`
- `Gallery: title, image, tag enum[products|events|behind-the-scenes|seasonal], sort_order`

## 5. Formulas / Business Logic Used

### F1 — Order Total Price (Core E-Commerce Formula)
**`total_price = unit_price × quantity`** — integer 1..99, 2-decimal currency (₹)
```php
// app/Http/Controllers/OrderController.php:56
$total = $product->price * $request->quantity; // e.g. 250.00 * 3 = 750.00
Order::create(['price'=>$product->price,'total_price'=>$total, ...]);
```
JS live mirror `resources/views/orders/create.blade.php:112`:
```js
const total = (price * (parseInt(qty) || 1)).toFixed(2); // price:110
```
Validation: `quantity required|integer|min:1|max:99` `OrderController.php:52`

### F2 — Product Image Filename Formula
`filename = LPAD(category_id,2,'0') + LPAD(count_in_category+1,2,'0') + sanitize(name) + .ext`
```php
// app/Http/Controllers/ProductsController.php:37-41 (store), 72-76 (update)
$catIndex = str_pad($category->id,2,'0',STR_PAD_LEFT);
$prodIndex= str_pad(Product::where('category_id',$catId)->count()+1,2,'0',STR_PAD_LEFT);
$safeName = strtolower(preg_replace('/[^a-zA-Z0-9]/','',$name));
$filename = $catIndex.$prodIndex.$safeName.'.'.$ext; // ex: 01="cakes", 03 => 0103chocolatecake.jpg
```
Stored: `products/` on `public` disk.

### F3 — Gallery Image Filename Formula
`filename = LPAD(tagIndex+1,2,'0') + LPAD(count_in_tag+1,2,'0') + sanitize(title) + .ext`
Tags `GalleryController.php:10` = `[products=01, events=02, behind-the-scenes=03, seasonal=04]`
```php
// app/Http/Controllers/GalleryController.php:32-36
$tagIndex = str_pad(array_search($tag,self::TAGS)+1,2,'0',STR_PAD_LEFT);
$itemIndex= str_pad(Gallery::where('tag',$tag)->count()+1,2,'0',STR_PAD_LEFT);
$filename = $tagIndex.$itemIndex.$safeName.'.'.$ext; // ex: 0205anniversary.jpg
```

### F4 — Dashboard Stats Aggregation
```php
// routes/web.php:62-68
'categories'=>categories::count(), 'products'=>Product::count(),
'orders'=>Order::count(), 'users'=>User::count(),
'contacts'=>Contact::count(), 'unread'=>Contact::where('is_read',false)->count()
```
Recent: `Contact::latest()->take(5)` — O(n) count queries, no caching.

### F5 — Featured Products Ranking
`withCount('orders') ORDER BY orders_count DESC LIMIT 4` — best-sellers
```php
// app/Http/Controllers/HomeController.php:11-14
Product::withCount('orders')->orderByDesc('orders_count')->take(4)->get();
```

### F6 — Client Price Sort (No Discount/Tax Formula)
```js
// resources/views/products/index.blade.php:609-610
if(v==='price-asc') sorted.sort((a,b)=>parseFloat(a.dataset.price)-parseFloat(b.dataset.price));
else if(v==='price-desc') sorted.sort((a,b)=>parseFloat(b.dataset.price)-parseFloat(a.dataset.price));
```
No tax/shipping/discount formula — flat `price` only. Search filter: `where name LIKE %query%` `HomeController.php:22`.

## 6. Notable Observations
- No cart: direct `POST /order` single-product order (quantity capped 99).
- Auth: `AuthController`, middleware `auth` + `role:admin`; status enum `pending|confirmed|processing|delivered|cancelled` `OrderController.php:29`.
- File validation: `image|max:2048|3072`, price `numeric|min:0`.
- No payment gateway; `total_price` persisted denormalized for history.
- Improvement: add tax/discount, transactions, soft deletes, rate limiting, image cleanup on delete.

## 7. Run
`composer setup` → `composer dev` (serve + queue + pail + vite) or `php artisan serve` + `npm run dev`. DB: `database/database.sqlite`.

---
*Generated: 2026-09-02 | Lines: ~145 | Source verified via codebase read*
