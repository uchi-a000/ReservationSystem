<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function reservation(Request $request)
    {
        $user = Auth::user();

        $reservation = $request->all();
        $reservation['user_id'] = $user->id;
        Reservation::create($reservation);

        return view('done', compact('reservation'));
    }

    public function update(Request $request)
    {
        $reservation = $request->all();
        Reservation::find($request->id)->update($reservation);

        return redirect()->back()->with('success', '予約情報が変更されました');
    }

    public function delete($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();

        return redirect()->route('my_page');
    }
}
