<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomRegisteredUserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\ShopRep\ShopRepController;

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
Route::get('/detail/{shop_id}', [HomeController::class, 'shopDetail'])->name('shop_detail');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::post('/register', [CustomRegisteredUserController::class, 'store'])->name('register');

Route::get('/reviews/{shop_id}', [ReviewController::class, 'index'])->name('reviews_index');


// メール認証の通知
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// メール認証処理
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('thanks');
})->middleware(['auth', 'signed'])->name('verification.verify');

// メール認証再送信
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', '確認メールを再送信しました');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/thanks', function () {
    return view('thanks');})->name('thanks');


Route::middleware('auth', 'verified')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/done', [ReservationController::class, 'reservation'])->name('reservation');
    Route::post('/done', [ReservationController::class, 'reservation'])->name('reservation');
    Route::get('/reservation/update/{id}', [ReservationController::class, 'showUpdate'])->name('reservation_update');
    Route::patch('/reservation/update_done/{id}', [ReservationController::class, 'update'])->name('reservation_update_done');
    Route::delete('/reservation/delete/{id}', [ReservationController::class, 'delete'])->name('reservation_delete');

    Route::match(['post', 'delete'], '/favorites/{shop}', [FavoriteController::class, 'toggleFavorite'])->name('favorites');

    Route::get('/review/{id}', [ReviewController::class, 'review'])->name('review');
    Route::post('/review_thanks', [ReviewController::class, 'reviewThanks'])->name('review_thanks');
    Route::get('/review/update/{id}', [ReviewController::class, 'showUpdate'])->name('review_update');
    Route::patch('/review/update/{id}', [ReviewController::class, 'update'])->name('review_update');
    Route::delete('/review/{review_id}/{shop_id}', [ReviewController::class, 'deleteReview'])->name('review_delete');



    Route::get('/mypage', [MypageController::class, 'myPage'])->name('my_page');
    Route::post('/generate_qr_code/{id}', [MypageController::class, 'generateQrCode'])->name('generate_qr_code');
    Route::get('/checkin/{id}', [MypageController::class, 'checkIn'])->name('check_in');
    Route::get('/payment/{id}', [MypageController::class, 'showPayment'])->name('stripe.payment_form');
    Route::post('/checkout', [MypageController::class, 'checkout'])->name('checkout');
    Route::get('/payment/success/{id}', [MypageController::class, 'success'])->name('stripe.success');
    Route::get('/payment/cancel/{id}', function ($id) {
        return view('stripe.cancel');
    })->name('stripe.cancel');
});

//管理者
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/representatives', [AdminController::class, 'adminIndex'])->name('admin.admin_index');
    Route::post('/representatives', [AdminController::class, 'store'])->name('admin.store');
    Route::delete('/reviews/delete/{review_id}', [AdminController::class, 'destroy'])->name('reviews_destroy');
    // お知らせメール
    Route::get('/notify', [AdminNotificationController::class, 'showNotificationForm'])->name('admin.notify');
    Route::post('/confirm', [AdminNotificationController::class, 'confirmNotification'])->name('admin.notify.confirm');
    Route::post('/notify', [AdminNotificationController::class, 'sendNotification'])->name('admin.notify.send');
    Route::get('/shops/import', [AdminController::class, 'showImport'])->name('admin.shops_import');
    Route::post('/shops/import', [AdminController::class, 'import'])->name('admin.shops_import');
});

//店舗代表者
Route::group(['prefix' => 'shop', 'middleware' => ['auth', 'role:shop_representative']], function() {
    Route::get('/info', [ShopRepController::class, 'shopRepIndex'])->name('shop_rep.shop_rep_index');
    Route::post('/confirm', [ShopRepController::class, 'confirm'])->name('shop_rep.confirm');
    Route::post('/done', [ShopRepController::class, 'store'])->name('shop_rep.store');
    Route::patch('/update', [ShopRepController::class, 'update'])->name('shop_rep.update');
    Route::get('/reservations', [ShopRepController::class, 'reservations'])->name('shop_rep.reservations');

});



