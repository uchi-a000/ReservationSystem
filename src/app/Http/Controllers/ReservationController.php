<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;


class ReservationController extends Controller
{

    public function reservation(ReservationRequest $request)
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

        session()->flash('success', [
            'message' => '予約情報が変更されました',
            'reservation_id' => $request->id
        ]);

        return redirect()->back();
    }

    public function delete($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();

        return redirect()->route('my_page');
    }

}
