<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomRegisteredUserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReservationController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/detail/{shop_id}', [HomeController::class, 'shop_detail'])->name('shop_detail');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::middleware('auth')->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/done', [ReservationController::class, 'reservation'])->name('reservation');
    Route::post('/done', [ReservationController::class, 'reservation'])->name('reservation');
    Route::patch('/reservations/update/{id}', [ReservationController::class, 'update'])->name('reservations_update');
    Route::delete('/reservations/delete/{id}', [ReservationController::class, 'delete'])->name('reservations_delete');

    Route::match(['post', 'delete'], '/favorites/{shop}', [FavoriteController::class, 'toggleFavorite'])->name('favorites');

    Route::get('/mypage', [MYpageController::class, 'my_page'])->name('my_page');

});