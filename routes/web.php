<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DishController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [PromotionController::class, 'readPromtions'])->name('home');

Route::get('/user/login', [UserController::class, 'showLoginForm'])->name('user.login');
Route::get('/user', [UserController::class, 'login'])->name('login');

Route::get('/user/signup', [UserController::class, 'showRegistrationForm'])->name('user.signup');
Route::post('/user', [UserController::class, 'store'])->name('user.store');

Route::get('/user/profile', [UserController::class, 'showProfile'])->name('profile.show');
Route::put('/user/profile', [UserController::class, 'updateProfile'])->name('profile.update');

Route::post('/user/logout', [UserController::class, 'logout'])->name('user.logout');

Route::get('/categories', [CategoryController::class, 'showCategories'])->name('categories');
Route::get('/categories/{category}', [CategoryController::class, 'showCategories'])->name('subcategories');

Route::get('/{category}/dishes', [DishController::class, 'showDishes'])->name('dishes');

Route::get('/promotions', [PromotionController::class, 'readPromtions'])->name('promotions');

Route::middleware('auth:client')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/add/{dish_id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
});

Route::middleware(['auth:client'])->group(function () {
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/remove', [OrderController::class, 'remove'])->name('orders.remove');
});




