<?php

namespace App\Http\Controllers\ShopRep;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ShopRepRequest;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;



class ShopRepController extends Controller
{
    public function shopRepIndex()
    {
        $shop = auth()->user()->shop;
        $areas = Area::all();
        $genres = Genre::all();

        $status = 0;

        if($shop && $shop->id){
            $status = 1;
        }

        return view('shop_rep.shop_rep_index', compact('shop', 'areas', 'genres', 'status'));
    }


    public function confirm(ShopRepRequest $request)
    {
        $shop = $request->all();

        $image_path = $request->file('image')->store('public/temp');
        $image_name = basename($image_path);

        $shop['image'] = $image_name;

        $area = Area::find($request->area_id);
        $genre = Genre::find($request->genre_id);

        $shop['area'] = $area ? $area->area : null;
        $shop['genre'] = $genre ? $genre->genre : null;



        return view('shop_rep.confirm', compact('shop'));
    }


    public function store(Request $request)
    {

        if ($request->has('back')) {
            return redirect('/shop/info')->withInput();
        }

        $user = auth()->user();

        $temp_path = storage_path('app/public/temp/' . $request->image);
        $new_path = storage_path('app/public/images/' . $request->image);

        rename($temp_path, $new_path);

        Shop::create([
            'user_id' => $user->id,
            'shop_name' => $request->shop_name,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'description' => $request->description,
            'image' => $request->image
        ]);

        return view('shop_rep.done');
    }


    public function update(ShopRepRequest $request)
    {
        if ($request->has('back')) {
            return redirect('/shop/info')->withInput();
        }

        $shop = Shop::find($request->id);

        if($request->hasFile('image')) {
            $image_path = $request->file('image')->store('public/images');
            $image_name = basename($image_path);
            $shop->image =$image_name;
        }

        Area::where('area', $request->area)->first();
        Genre::where('genre', $request->genre)->first();

        $shop_data = [
            'shop_name' => $request->shop_name,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'description' => $request->description,
        ];

        $shop->update($shop_data);

        return redirect()->route('shop_rep.shop_rep_index')->with('message', '店舗情報を変更しました');
    }


    public function reservations(Request $request)
    {
        $shop = auth()->user()->shop;
        $reservations_query = Reservation::where('shop_id', $shop->id)->with('user');

        if($request->has('reservation_id')) {
            $reservations_query->where('id', $request->reservation_id);
        }
        $reservations = $reservations_query->get();

        return view('shop_rep.reservations', compact('shop', 'reservations'));
    }
}
