<?php

namespace App\Http\Controllers\ShopRep;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ShopRepRequest;
use App\Models\Shop;
use App\Models\Reservation;



class ShopRepController extends Controller
{
    public function shopRepIndex()
    {
        $shop = auth()->user()->shop;
        $areas = ['#東京都','#大阪府','#福岡県'];
        $genres = ['#焼肉', '#居酒屋', '#寿司','#ラーメン', '#イタリアン'];

        $status = 0;

        if($shop && $shop->id){
            $status = 1;
        }

        return view('shop_rep.shop_rep_index', compact('shop', 'areas', 'genres', 'status'));
    }


    public function confirm(ShopRepRequest $request)
    {
        $shop = $request->all();

        $imagePath = $request->file('image')->store('public/temp');
        $imageName = basename($imagePath);

        $shop['image'] = $imageName;


        return view('shop_rep.confirm', compact('shop'));
    }


    public function store(Request $request)
    {

        if ($request->has('back')) {
            return redirect('/shop/info')->withInput();
        }

        $user = auth()->user();

        $tempPath = storage_path('app/public/temp/' . $request->image_url);
        $newPath = storage_path('app/public/images/' . $request->image_url);

        rename($tempPath, $newPath);

        Shop::create([
            'user_id' => $user->id,
            'shop_name' => $request->shop_name,
            'area' => $request->area,
            'genre' => $request->genre,
            'description' => $request->description,
            'image' => $request->image_url
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
            $imagePath = $request->file('image')->store('public/images');
            $imageName = basename($imagePath);
            $shop->image_url =$imageName;
        }

        $shopData = $request->only(['shop_name', 'area', 'genre', 'description']);
        $shop->update($shopData);

        return redirect()->route('shop_rep.shop_rep_index')->with('message', '店舗情報を変更しました');
    }


    public function reservations(Request $request)
    {
        $shop = auth()->user()->shop;
        $reservationsQuery = Reservation::where('shop_id', $shop->id)
                                        ->with('user');

        if($request->has('reservation_id')) {
            $reservationsQuery->where('id', $request->reservation_id);
        }
        $reservations = $reservationsQuery->get();

        return view('shop_rep.reservations', compact('shop', 'reservations'));
    }
}
