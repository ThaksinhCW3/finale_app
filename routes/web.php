<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'home']);

Route::get('/dashboard', [HomeController::class, 'login_home'])
->middleware(['auth', 'verified'])->name('dashboard');

route::get('product_details/{id}',[HomeController::class, 'details_product']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
Route::get('dashboard', [HomeController::class, 'index']);
Route::get('category/view_category', [CategoryController::class, 'view_category']);
route::post('category/add_category',[CategoryController::class, 'add_category']);
Route::get('category/delete_category/{id}', [CategoryController::class, 'delete_Category']);
Route::get('category/edit_category/{id}', [CategoryController::class, 'edit_Category']);
Route::post('category/update_category/{id}', [CategoryController::class, 'update_Category']);

Route::get('product/view_product', [ProductController::class, 'view_product']);
Route::get('product/add_product', [ProductController::class, 'add_Product']);
Route::post('product/upload_product', [ProductController::class, 'upload_Product']);
Route::get('product/delete_product/{id}', [ProductController::class, 'delete_Product']);
Route::get('product/edit_product/{id}', [ProductController::class, 'edit_Product']);
Route::post('product/update_product/{id}', [ProductController::class, 'update_Product']);
Route::post('product/product_search', [ProductController::class, 'search_Product']);
});