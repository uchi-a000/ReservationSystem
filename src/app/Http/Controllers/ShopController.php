<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::all();

        return view('index', compact('shops'));
    }

    public function shop_detail($id)
    {
        $shop = Shop::find($id);

        return view('shop_detail', compact('shop'));
    }

    public function reservation(Request $request){

        $user = Auth::user();

        $shopId = $request->input('shop_id');
        $reservationDate = $request->input('reservation_date');
        $reservationTime = $request->input('reservation_time');
        $numberOfPeople = $request->input('number_of_people');


        Reservation::create([
            'user_id' => $user->id,
            'shop_id' => $shopId,
            'reservation_date' => $reservationDate,
            'reservation_time' => $reservationTime,
            'number_of_people' => $numberOfPeople
        ]);

        return view('done');
    }
}
