<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\PaymentRequest;
use Stripe\Stripe;
use Stripe\Checkout\Session;





class MypageController extends Controller
{
    public function myPage()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->with('shop', 'reviews')->orderBy('reservation_date', 'desc')->get();
        $favorites = Favorite::where('user_id', $user->id)->with('shop')->get();
        $reviews = Review::where('user_id', $user->id)->with('reservation')->get();

        $now = Carbon::now();

        foreach ($reservations as $reservation) {

            $reservationDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $reservation->reservation_date . ' ' . $reservation->reservation_time);
            $dayBefore = $reservationDateTime->copy()->subDay();

            $reservation->reservationDateTime = $reservationDateTime;
            $reservation->dayBefore = $dayBefore;
        }

        return view('my_page', compact('user', 'reservations', 'favorites', 'now', 'reviews'));
    }


    public function generateQrCode($id) {

        $reservation = Reservation::find($id);
        $qrCodes = [];

        $qrCodes[$reservation->id] = QrCode::size(150)->generate(route('check_in', $reservation->id));

        return view('generate_qr_code', compact('reservation','qrCodes'));
    }


    public function checkIn(Request $request) {

        $reservation = Reservation::find($request->id);

        $reservation->check_in = true;
        $reservation->save();

        return view('check_in', compact('reservation'));
    }


    public function review($id) {

        $reservation = Reservation::find($id);

        return view('review', compact('reservation'));
    }

    public function reviewThanks(ReviewRequest $request) {

        $reservation = Reservation::find($request->reservation_id);

        Review::create([
            'user_id' => auth()->id(),
            'shop_id' => $request->shop_id,
            'reservation_id' => $request->reservation_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return view('review_thanks', compact('reservation'));
    }


    public function showPayment($id) {

        $reservation = Reservation::find($id);

        return view('stripe.payment', compact('reservation'));
    }

    public function checkout(PaymentRequest $request) {

        Stripe::setApiKey(config('services.stripe.secret'));

        $reservation = Reservation::find($request->input('reservation_id'));

        try {
            $amount = $request->input('amount');

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => [
                            'name' => '店舗名:' . $reservation->shop->shop_name,
                        ],
                        'unit_amount' => $amount,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('stripe.success', $reservation->id),
                'cancel_url' => route('stripe.cancel', $reservation->id),
            ]);

            return redirect($session->url);
        } catch (\Exception $e) {
            return redirect()->route('stripe.payment_form', $reservation->id)->with('error', '決済に失敗しました。もう一度お試しください.
            ' . $e->getMessage()) ;
        }
    }

    public function success($id) {

        $reservation = Reservation::find($id);

            $reservation->paid = true;
            $reservation->save();

        return view('stripe.success', compact('reservation'));
    }

}