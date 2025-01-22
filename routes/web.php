<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClientController;
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

Route::get('/', [HomeController::class, 'getInformationForHomePage'])->name('home');
Route::get('/greeting/{locale}', [LocalizationController::class, 'locale'])->name('changeLanguage');

Route::prefix('/clients')
    ->controller(ClientController::class)
    ->group(function () {
        Route::get('/login', 'showLoginForm')->name('client.login.form');
        Route::post('/login', 'login')->name('client.login');

        Route::get('/signup', 'showRegistrationForm')->name('client.signup');
        Route::post('/', 'store')->name('client.store');

        Route::middleware(['auth:client'])->group(function () {
            Route::get('/profile', 'showProfile')->name('profile.show');
            Route::put('/profile', 'updateProfile')->name('profile.update');

            Route::post('/logout', 'logout')->name('client.logout');
        });
    });

Route::prefix('/categories')
    ->controller(CategoryController::class)
    ->group(function () {
        Route::get('/', 'showCategories')->name('categories');
        Route::get('/{category}', 'showCategoriesById')->name('subcategories');
    });

Route::get('/{category}/dishes', [DishController::class, 'showDishes'])->name('dishes');
Route::get('/promotions', [PromotionController::class, 'readPromotions'])->name('promotions');

Route::middleware('auth:client')->group(function () {
    Route::prefix('/cart')
        ->controller(CartController::class)
        ->group(function () {
            Route::get('/', 'index')->name('cart.index');
            Route::get('/add/{dish_id}', 'add')->name('cart.add');
            Route::post('/update', 'update')->name('cart.update');
            Route::delete('/remove', 'remove')->name('cart.remove');
        });
});

Route::middleware(['auth:client'])->group(function () {
    Route::prefix('/orders')
        ->controller(OrderController::class)
        ->group(function () {
            Route::get('/', 'index')->name('order.index');
            Route::post('/', 'store')->name('orders.store');
            Route::get('/placingOrder', 'placingOrder')->name('orders.placingOrder');
            Route::get('/{order}', 'show')->name('orders.show');
            Route::delete('/{order}/remove', 'remove')->name('orders.remove');
        });
});
