<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;



class MypageController extends Controller
{
    public function my_page(){

        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->with('shop')->get();
        $favorites = Favorite::where('user_id', $user->id)->with('shop')->get();

        foreach ($reservations as $reservation){
            if (Carbon::now()->greaterThan($reservation->reservation_date)) {
                $qrCodes[$reservation->id] = QrCode::size(150)->generate('https://example.com');
            } else {
                $qrCodes[$reservation->id] = null;
            }
        }

        return view('my_page', compact('user', 'reservations', 'favorites', 'qrCodes',));
    }
}
