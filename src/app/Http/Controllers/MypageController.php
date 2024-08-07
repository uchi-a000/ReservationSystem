<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;



class MypageController extends Controller
{
    public function my_page()
    {

        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->with('shop')->get();
        $favorites = Favorite::where('user_id', $user->id)->with('shop')->get();

        $now = Carbon::now();

        foreach ($reservations as $reservation) {

            $reservationDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $reservation->reservation_date . ' ' . $reservation->reservation_time);
            $dayBefore = $reservationDateTime->copy()->subDay();

            $reservation->reservationDateTime = $reservationDateTime;
            $reservation->dayBefore = $dayBefore;

        }

        return view('my_page', compact('user', 'reservations', 'favorites', 'now'));
    }


    public function generateQrCode($id) {

        $reservation = Reservation::find($id);

        $qrCodes[$reservation->id] = QrCode::size(150)->generate('https://example.com');

        return view('generate_qr_code', compact('reservation','qrCodes'));

    }


    public function checkIn(Request $request) {

        $reservation = Reservation::find($request->id);

        $reservation->check_in = true;
        $reservation->save();

        return view('checkin', compact('reservation'));

    }

}
