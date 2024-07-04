<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CustomRegisteredUserController;


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

Route::get('/', [ShopController::class, 'index']);
Route::get('/detail/{shop_id}', [ShopController::class, 'shop_detail'])->name('shop_detail');

Route::middleware('auth')->group(function() {
    Route::post('/done', [ShopController::class, 'reservation'])->name('reservation');
});