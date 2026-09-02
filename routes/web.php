<?php




use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\OrderController;


Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('/products', [HomeController::class, 'allProducts'])->name('products.all');

Route::get('/cakes',[HomeController::class,'Cakes'])->name('products.cakes');
Route::get('/cupcakes',[HomeController::class,'CupCakes'])->name('products.cupcakes');
Route::get('/cookies',[HomeController::class,'Cookies'])->name('products.cookies');
Route::get('/breads', [HomeController::class, 'Breads'])->name('products.breads');
Route::get('/donuts-desserts',[HomeController::class, 'DonetsDeserts'])->name('products.donuts');

Route::get('/about', fn() => view('about.index'))->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
// Auth
Route::get('/login', [AuthController::class, 'showlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showregister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/gallery', [GalleryController::class, 'publicIndex'])->name('gallery.public');

// Orders - public
Route::middleware('auth')->group(function () {
    Route::get('/order/{product}', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/order', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/success', [OrderController::class, 'success'])->name('orders.success');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
});

// Orders - admin
Route::prefix('admin')->middleware(['role:admin'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
});

// Admin protected routes
Route::middleware(['role:admin'])->prefix('admin')->group(function () {
    Route::resource('categories', CategoriesController::class)->parameters(['categories' => 'category']);
    Route::resource('products', ProductsController::class);
    Route::resource('gallery', GalleryController::class);

    Route::get('/dashboard', function () {
        // Provide dashboard stats (kept in route closure for simplicity)
        $stats = [
            'categories' => \App\Models\categories::count(),
            'products'   => \App\Models\Product::count(),
            'orders'     => \App\Models\Order::count(),
            'users'      => \App\Models\User::count(),
            'contacts'   => \Illuminate\Support\Facades\Schema::hasTable('contacts') ? \App\Models\Contact::count() : 0,
            'unread'     => \Illuminate\Support\Facades\Schema::hasTable('contacts') ? \App\Models\Contact::where('is_read', false)->count() : 0,
        ];
        $recentContacts = \Illuminate\Support\Facades\Schema::hasTable('contacts') ? \App\Models\Contact::latest()->take(5)->get() : collect();
        $contactDetail = \Illuminate\Support\Facades\Schema::hasTable('contact_details') ? \App\Models\ContactDetail::singleton() : null;
        return view('admin.dashboard', compact('stats', 'recentContacts', 'contactDetail'));
    })->name('admin.dashboard');

    // ── Contact admin ──────────────────────────────────
    Route::get('/contacts', [ContactController::class, 'adminIndex'])->name('admin.contacts.index');
    Route::get('/contacts/settings', [ContactController::class, 'editDetails'])->name('admin.contacts.settings');
    Route::put('/contacts/settings', [ContactController::class, 'updateDetails'])->name('admin.contacts.settings.update');
    Route::get('/contacts/{contact}', [ContactController::class, 'adminShow'])->name('admin.contacts.show');
    Route::patch('/contacts/{contact}/toggle-read', [ContactController::class, 'adminToggleRead'])->name('admin.contacts.toggleRead');
    Route::delete('/contacts/{contact}', [ContactController::class, 'adminDestroy'])->name('admin.contacts.destroy');
});
