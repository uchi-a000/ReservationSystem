<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class HomeController extends Controller
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
        $numberOfPeopleOptions = range(1, 15);

        $startTime = Carbon::today()->hour(11)->minute(0);
        $endTime = Carbon::today()->hour(21)->minute(0);
        $interval = 30;

        $timeOptions = [];
        while($startTime <= $endTime){
            $timeOptions[] = $startTime->format('H:i');
            $startTime->addMinutes($interval);
        }

        return view('shop_detail', compact('shop', 'reservations', 'numberOfPeopleOptions', 'timeOptions'));
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
