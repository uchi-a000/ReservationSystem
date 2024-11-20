<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class HomeController extends Controller
{
    public function index()
    {
        $shops = Shop::with('reviews')->get();

        return view('index', compact('shops'));
    }

    public function shopDetail($shop_id)
    {
        $shop = Shop::find($shop_id);
        $user_id = Auth::id();
        $review = Review::where('shop_id', $shop_id)->where('user_id', $user_id)->first();

        $reservations = Reservation::where('shop_id', $shop_id)
                                    ->where('user_id', $user_id)
                                    ->get();

        $number_of_people_options = range(1, 15);

        $start_time = Carbon::today()->hour(11)->minute(0);
        $end_time = Carbon::today()->hour(21)->minute(0);
        $interval = 30;

        $time_options = [];
        while($start_time <= $end_time){
            $time_options[] = $start_time->format('H:i');
            $start_time->addMinutes($interval);
        }

        return view('shop_detail', compact('shop', 'review', 'reservations', 'number_of_people_options', 'time_options', 'shop_id'));
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

        if($request->sort === 'random') {
            $query->inRandomOrder();

        } elseif ($request->sort === 'high_rating') {
            $query->withAvg('reviews', 'rating')
                    ->orderBy('reviews_avg_rating', 'desc')
                    ->orderBy('id');

        } elseif ($request->sort === 'low_rating') {
            $query->withAvg('reviews', 'rating')
                    ->orderByRaw('reviews_avg_rating IS NULL ASC')
                    ->orderBy('reviews_avg_rating', 'asc')
                    ->orderBy('id');
        }

        return $query;
    }

}
