<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function my_page(){

        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->with('shop')->get();
        $favorites = Favorite::where('user_id', $user->id)->with('shop')->get();

        return view('my_page', compact('user', 'reservations', 'favorites'));
    }

    public function updateReservation(Request $request, $id){

        $reservation = Reservation::find($id);

        $request->validate([
            'reservation_date' => 'nullable|date',
            'reservation_time' => 'nullable|date_format:H:i',
            'number_of_people' => 'nullable|integer|min1',
        ]);

        $reservation->reservation_date = $request->input('reservation_date');
        $reservation->reservation_time = $request->input('reservation_time');
        $reservation->number_of_people = $request->input('number_of_people');
        $reservation->save();

        return redirect()->route('my_page')->with('success', '予約情報が変更されました');
    }

    public function deleteReservation($id){

        $reservation = Reservation::find($id);

        $reservation->delete();

        return redirect()->route('my_page')->with('success', '予約情報が削除されました');
    }

}
