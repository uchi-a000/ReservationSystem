<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CustomRegisteredUserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MypageController;


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

Route::post('/register', [CustomRegisteredUserController::class, 'store']);
Route::get('/thanks', [CustomRegisteredUserController::class, 'store'])->name('thanks');

Route::get('/', [ShopController::class, 'index'])->name('home');
Route::get('/detail/{shop_id}', [ShopController::class, 'shop_detail'])->name('shop_detail');
Route::get('/search', [ShopController::class, 'search'])->name('search');

Route::middleware('auth')->group(function() {
    Route::get('/home', [ShopController::class, 'index'])->name('home');
    Route::get('/done', [ShopController::class, 'reservation'])->name('reservation');
    Route::post('/done', [ShopController::class, 'reservation'])->name('reservation');

    Route::match(['post', 'delete'], '/favorites/{shop}', [FavoriteController::class, 'toggleFavorite'])->name('favorites');

    Route::get('/mypage', [MYpageController::class, 'my_page'])->name('my_page');
    Route::post('/reservations/update/{id}', [MypageController::class, 'updateReservation'])->name('reservations_update');
    Route::post('/reservations/delete/{id}', [MypageController::class, 'deleteReservation'])->name('reservations_delete');


});