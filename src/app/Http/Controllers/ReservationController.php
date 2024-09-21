<?php

namespace App\Http\Controllers;

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

    public function showUpdate($id)
    {
        $reservation = Reservation::find($id);

        return view('reservation_update', compact('reservation'));
    }

    public function update(ReservationRequest $request)
    {
        $reservation = Reservation::find($request->id);

        $reservation_data = $request->only(['reservation_date', 'reservation_time', 'number_of_people']);

        $reservation->update($reservation_data);

        return view('reservation_update_done', compact('reservation'));
    }

    public function delete($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();

        return redirect()->route('my_page')->with('message', '予約をキャンセルしました' );
    }

}
