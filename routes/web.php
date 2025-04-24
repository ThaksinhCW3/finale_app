<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;

use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\User\UserCartController;
use App\Http\Controllers\User\UserHomeController;

Route::get('/', [UserHomeController::class, 'home']);
Route::get('/dashboard', [UserHomeController::class, 'login_home'])->middleware(['auth', 'verified'])->name('dashboard');

// Routes that require authentication
Route::middleware(['auth', 'verified'])->prefix('cart')
->name('cart.')->group(function () {
    Route::get('add_cart/{id}', [UserCartController::class, 'add_cart']);
    Route::get('my_cart', [UserCartController::class, 'my_cart']);
});

Route::controller(UserCartController::class)->group(function(){
    Route::get('stripe/{value}', 'stripe');
    Route::post('stripe/{value}', 'stripePost')->name('stripe.post');
});

Route::middleware(['auth', 'verified'])->prefix('order')->name('order.')->group(function () {
    Route::get('my_order', [UserOrderController::class, 'my_order']);
    Route::post('confirm_order', [UserOrderController::class, 'confirm_order']);
});

// Public product route
Route::prefix('product')->group(function () {
    Route::get('product_details/{id}', [UserProductController::class, 'details_product']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

Route::get('dashboard', [AdminHomeController::class, 'index']);
Route::get('category/view_category', [AdminCategoryController::class, 'view_category']);
Route::post('category/add_category',[AdminCategoryController::class, 'add_category']);
Route::get('category/delete_category/{id}', [AdminCategoryController::class, 'delete_Category']);
Route::get('category/edit_category/{id}', [AdminCategoryController::class, 'edit_Category']);
Route::post('category/update_category/{id}', [AdminCategoryController::class, 'update_Category']);

Route::get('product/view_product', [AdminProductController::class, 'view_product']);
Route::get('product/add_product', [AdminProductController::class, 'add_Product']);
Route::post('product/upload_product', [AdminProductController::class, 'upload_Product']);
Route::get('product/delete_product/{id}', [AdminProductController::class, 'delete_Product']);
Route::get('product/edit_product/{id}', [AdminProductController::class, 'edit_Product']);
Route::post('product/update_product/{id}', [AdminProductController::class, 'update_Product']);
Route::post('product/product_search', [AdminProductController::class, 'search_Product']);

Route::get('order/view_order', [AdminOrderController::class, 'view_Order']);
Route::get('order/on_the_way_order/{id}', [AdminOrderController::class, 'on_the_way_Order']);
Route::get('order/delivered_order/{id}', [AdminOrderController::class, 'delivered_Order']);
Route::get('order/print_pdf/{id}', [AdminOrderController::class, 'print_pdf']);
});