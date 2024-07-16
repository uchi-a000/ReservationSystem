<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function my_page(){

        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->with('shop')->get();
        $favorites = Favorite::where('user_id', $user->id)->with('shop')->get();

        return view('my_page', compact('user', 'reservations', 'favorites'));
    }
}
