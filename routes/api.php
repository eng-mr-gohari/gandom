<?php

use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\BasketController;
use App\Http\Controllers\API\CardController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/user', function () {
    return request()->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/login', [RegisterController::class, 'login'])->name('login');
    Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');
});

Route::group(['as' => 'products', 'prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('items');
    Route::get('/show/{id}', [ProductController::class, 'show'])->name('show');
});

Route::group(['as' => 'baskets', 'prefix' => 'baskets'], function () {
    Route::get('/', [BasketController::class, 'CustomerIndex'])->name('customer.items');
    Route::post('/user/store', [BasketController::class, 'CustomerStore'])->name('customer.store');
    Route::get('/item/{id}', [BasketController::class, 'show'])->name('selectItem');
    Route::patch('/update/{id}', [BasketController::class, 'updateItem'])->name('updateItem');
    Route::delete('/delete/{id}', [BasketController::class, 'deleteItem'])->name('deleteItem');
});

Route::group(['as' => 'card', 'prefix' => 'card'], function () {
    Route::get('/send-notification/{id}', [CardController::class, 'sendNotification'])->name('send.invoice.mail');
    Route::get('/get-notification/{id}', [CardController::class, 'getNotification'])->name('get.invoice.mail');
});

Route::group(['as' => 'users', 'prefix' => 'users'], function () {
    Route::get('/active/list', [UserController::class, 'index'])->name('index');
    Route::get('/active/{id}', [UserController::class, 'show'])->name('show');
});

