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

        $user_id = Auth::id();

        $reservations = Reservation::where('shop_id', $id)
                                    ->where('user_id', $user_id)
                                    ->get();

        return view('shop_detail', compact('shop', 'reservations'));
    }

    public function reservation(Request $request){

        $user = Auth::user();

        $reservation = new Reservation();
        $reservation->user_id = $user->id;
        $reservation->shop_id = $request->input('shop_id');
        $reservation->reservation_date = $request->input('reservation_date');
        $reservation->reservation_time = $request->input('reservation_time');
        $reservation->number_of_people = $request->input('number_of_people');
        $reservation->save();

        return view('done', compact('reservation'));
    }

    public function search(Request $request)
    {

        $query = Shop::query();
        $query = $this->getSearchQuery($request, $query);

        $shops = $query->get();

        return view('index', compact('shops'));
    }

    private function getSearchQuery($request, $query)
    {
        if (!empty($request->keyword)) {
            $query->where(function ($q) use ($request) {
                $q->where('shop_name', 'like', '%' . $request->keyword . '%');
            });
        }

        if (!empty($request->area)) {
            $query->where('area', '=', '#' . $request->area);
        }

        if (!empty($request->genre)) {
            $query->where('genre', '=', '#' . $request->genre);
        }

        return $query;
    }
}
