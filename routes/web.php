<?php

use App\Http\Controllers\adminOrder;
use App\Http\Controllers\adminOrderController;
use App\Http\Controllers\adminUser;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactInfoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopeController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;




Route::get('/Home', [HomeController::class, 'Homepage'])->name('dashboard');
Route::get('/shop/{caregory?}', [ShopeController::class, 'index'])->name('frontend.Shop');
Route::get('/product-details/{product?}', [ShopeController::class, 'show'])->name('frontend.ProductDetails');

//--------Contact
Route::get('/Contact', [ContactController::class, 'index'])->name('frontend.Contact.inedx');
Route::post('/Contact/store', [ContactController::class, 'store'])->name('frontend.Contact.store');



Route::middleware('admin')->group(function () {
    Route::get('/user', [adminUser::class, 'index'])->name('backend.user.index');
    Route::get('/user/edit/{user}', [adminUser::class, 'edit'])->name('backend.user.edit');
    Route::put('/user/update/{user}', [adminUser::class, 'update'])->name('backend.user.update');
    Route::delete('/user/destroy/{user}', [adminUser::class, 'destroy'])->name('backend.user.destroy');
});
Route::middleware(['editor'])->group(function () {
    Route::get('/Admin', [HomeController::class, 'Adminpage'])->name('backend.index');
    // Category
    Route::get('/categories', [CategoryController::class, 'index'])->name('backend.Categories.index');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('backend.Categories.store');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('backend.Categories.create');
    Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])->name('backend.Categories.edit');
    Route::put('/categories/update/{category}', [CategoryController::class, 'update'])->name('backend.Categories.update');
    Route::delete('/categories/destroy/{category}', [CategoryController::class, 'destroy'])->name('backend.Categories.destroy');

    //-------Brand
    Route::get('/brand', [BrandController::class, 'index'])->name('backend.Brand.index');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('backend.Brand.store');
    Route::get('/brand/create', [BrandController::class, 'create'])->name('backend.Brand.create');
    Route::get('/brand/edit/{brand}', [BrandController::class, 'edit'])->name('backend.Brand.edit');
    Route::put('/brand/update/{brand}', [BrandController::class, 'update'])->name('backend.Brand.update');
    Route::delete('/brand/destroy/{brand}', [BrandController::class, 'destroy'])->name('backend.Brand.destroy');


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

    //--------Order
    Route::get('/order', [adminOrderController::class, 'index'])->name('backend.Order.index');
    Route::get('/order/{order}', [adminOrderController::class, 'show'])->name('backend.Order.show');
    Route::delete('/order/{order}', [adminOrderController::class, 'destroy'])->name('backend.Order.destroy');
    Route::get('/orderPending/{id}', [adminOrderController::class, 'orderPending'])->name('backend.orderPending');
    Route::get('/orderDelivery/{id}', [adminOrderController::class, 'orderDelivery'])->name('backend.orderDelivery');

    //-------Slider
    Route::get('/slider', [SliderController::class, 'index'])->name('backend.Slider.index');
    Route::get('/slider/create', [SliderController::class, 'create'])->name('backend.Slider.create');
    Route::post('/slider/store', [SliderController::class, 'store'])->name('backend.Slider.store');
    Route::get('/slider/edit/{slider}', [SliderController::class, 'edit'])->name('backend.Slider.edit');
    Route::put('/slider/update/{slider}', [SliderController::class, 'update'])->name('backend.Slider.update');
    Route::delete('/slider/destroy/{slider}', [SliderController::class, 'destroy'])->name('backend.Slider.destroy');

    //-------Contact info

    Route::get('/Contact_ifo', [ContactInfoController::class, 'index'])->name('backend.Info.index');
    Route::get('/Contact_ifo/create', [ContactInfoController::class, 'create'])->name('backend.Info.create');
    Route::post('/Contact_ifo/store', [ContactInfoController::class, 'store'])->name('backend.Info.store');
    Route::get('/Contact_ifo/edit/{contact_info}', [ContactInfoController::class, 'edit'])->name('backend.Info.edit');
    Route::put('/Contact_ifo/update/{contact_info}', [ContactInfoController::class, 'update'])->name('backend.Info.update');
    Route::delete('/Contact_ifo/destroy/{contact_info}', [ContactInfoController::class, 'destroy'])->name('backend.Info.destroy');
});





Route::middleware(['user',])->group(function () {
    //-------profile account user

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/change-passord', [ProfileController::class, 'changePassowrd'])->name('profile.change-passord');
    Route::get('/delete-account', [ProfileController::class, 'deleteAccount'])->name('profile.delete-account');
    Route::delete('/profile/delete-account', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //-------cart

    Route::get('/cart', [CartController::class, 'cart'])->name('frontend.cart');
    Route::get('/cart/{cartid}', [CartController::class, 'destroy'])->name('frontend.destroy');
    Route::post('/add-cart/{id}', [CartController::class, 'addToCart'])->name('frontend.addToCart');
    Route::put('/cart/update-all', [CartController::class, 'updateCartAll'])->name('frontend.updateCartAll');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('frontend.checkout');
    Route::post('/checkoutStore', [CartController::class, 'checkoutStore'])->name('frontend.checkoutStore');
});


require __DIR__ . '/auth.php';
