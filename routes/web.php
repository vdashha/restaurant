<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\CategoryController;
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

Route::post('/user/logout', function () {
    Auth::logout();
    return redirect()->route('home'); // Перенаправление на главную страницу после выхода
})->name('user.logout');

Route::get('/categories', [CategoryController::class, 'readCategories'])->name('categories');

Route::get('/promotions', [PromotionController::class, 'readPromtions'])->name('promotions');



