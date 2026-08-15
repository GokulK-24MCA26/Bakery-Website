<?php




use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;


Route::get('/',[HomeController::class,'index'])->name('home');


Route::get('/cakes',[HomeController::class,'Cakes']);
Route::get('/cupcakes',[HomeController::class,'CupCakes']);
Route::get('/cookies',[HomeController::class,'Cookies']);
Route::get('/breads', [HomeController::class, 'Breads']);
Route::get('/donets&deserts',[HomeController::class, 'DonetsDeserts']);

Route::get('/about', fn() => view('about.index'))->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
// Auth
Route::get('/login', [AuthController::class, 'showlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showregister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('admin/categories', CategoriesController::class)->parameters(['categories' => 'category']);
Route::resource('admin/products', ProductsController::class);
Route::get('/gallery', [GalleryController::class, 'publicIndex'])->name('gallery.public');
Route::resource('admin/gallery', GalleryController::class);

// Admin protected routes
Route::middleware(['role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
