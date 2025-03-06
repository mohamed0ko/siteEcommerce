<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.index');
});
Route::get('/admin', function () {
    return view('backend.index');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */


Route::get('/dashboard', [HomeController::class, 'Premiun'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/shop', [ShopeController::class, 'index'])->name('frontend.Shop');
Route::get('/product-details/{product?}', [ShopeController::class, 'show'])->name('frontend.ProductDetails');



Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //admin
    //------categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('backend.Categories.index');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('backend.Categories.store');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('backend.Categories.create');
    Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])->name('backend.Categories.edit');
    Route::put('/categories/update/{category}', [CategoryController::class, 'update'])->name('backend.Categories.update');
    Route::delete('/categories/destroy/{category}', [CategoryController::class, 'destroy'])->name('backend.Categories.destroy');
    //-------color
    Route::get('/color', [ColorController::class, 'index'])->name('backend.Color.index');
    Route::post('/color/store', [ColorController::class, 'store'])->name('backend.Color.store');
    Route::get('/color/create', [ColorController::class, 'create'])->name('backend.Color.create');
    Route::get('/color/edit/{color}', [ColorController::class, 'edit'])->name('backend.Color.edit');
    Route::put('/color/update/{color}', [ColorController::class, 'update'])->name('backend.Color.update');
    Route::delete('/color/destroy/{color}', [ColorController::class, 'destroy'])->name('backend.Color.destroy');
    //-------Product
    Route::get('/product', [ProductController::class, 'index'])->name('backend.Product.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('backend.Product.show');
    Route::post('/product/store', [ProductController::class, 'store'])->name('backend.Product.store');
    Route::get('/product/create', [ProductController::class, 'create'])->name('backend.Product.create');
    Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('backend.Product.edit');
    Route::put('/product/update/{product}', [ProductController::class, 'update'])->name('backend.Product.update');
    Route::delete('/product/destroy/{product}', [ProductController::class, 'destroy'])->name('backend.Product.destroy');
    //------------

    Route::get('/cart', [CartController::class, 'cart'])->name('frontend.cart');
    Route::get('/cart/{cartid}', [CartController::class, 'destroy'])->name('frontend.destroy');
    Route::post('/add-cart/{id}', [CartController::class, 'addToCart'])->name('frontend.addToCart');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('frontend.checkout');
    Route::post('/checkoutStore', [CartController::class, 'checkoutStore'])->name('frontend.checkoutStore');
});


require __DIR__ . '/auth.php';
