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

}