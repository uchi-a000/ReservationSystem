<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomRegisteredUserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReservationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/detail/{shop_id}', [HomeController::class, 'shop_detail'])->name('shop_detail');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::post('/register', [CustomRegisteredUserController::class, 'store'])->name('register');

// メール認証の通知
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// メール認証処理（ユーザーがメール内のリンクをクリックした時に処理）
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

// 認証後に登録完了ページにリダイレクト
    return redirect()->route('thanks');
})->middleware(['auth', 'signed'])->name('verification.verify');

// メール認証再送信
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');


Route::middleware('auth')->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/done', [ReservationController::class, 'reservation'])->name('reservation');
    Route::post('/done', [ReservationController::class, 'reservation'])->name('reservation');

    Route::patch('/reservations/update/{id}', [ReservationController::class, 'update'])->name('reservations_update');
    Route::delete('/reservations/delete/{id}', [ReservationController::class, 'delete'])->name('reservations_delete');

    Route::match(['post', 'delete'], '/favorites/{shop}', [FavoriteController::class, 'toggleFavorite'])->name('favorites');

    Route::get('/mypage', [MypageController::class, 'my_page'])->name('my_page');
    Route::post('/generate_qr_code{id}', [MypageController::class, 'generateQrCode'])->name('generate_qr_code');
    Route::get('/checkin/{id}', [MypageController::class, 'checkIn'])->name('checkin');

});