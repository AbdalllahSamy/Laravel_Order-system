<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\User\UserBagController;
use App\Http\Controllers\User\UserOrdersController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware(['auth'])->group(function () {


    Route::resource('/users-action', UserController::class);
    Route::get('/users', [UserController::class, 'user_home'])->name('user.home');
    Route::resource('/menu-actions', MenuController::class);
    Route::get('/menu', [MenuController::class, 'menu_home'])->name('menu.home');
    Route::resource('/orders-action', OrderController::class);
    Route::get('/orders', [OrderController::class, 'order_home'])->name('orders.home');
    Route::resource('/feedbacks-actions', FeedbackController::class);
    Route::get('/feedbacks', [FeedbackController::class, 'feedback_home'])->name('feedbacks.home');

    Route::prefix('users')->group(function () {
        Route::get('/orders', [UserOrdersController::class, 'order_user_home'])->name('orders');
        Route::post('/orders', [UserOrdersController::class, 'store']);
        Route::resource('/bag-action', UserBagController::class);
        Route::get('/myBagCount', [UserBagController::class, 'allMyBagCount']);
        Route::get('/mybag', [UserBagController::class, 'myBag'])->name('bag.home');
    });

});
