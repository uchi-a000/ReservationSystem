<?php

namespace App\Http\Controllers\ShopRep;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Http\Requests\ShopRepRequest;


class ShopRepController extends Controller
{
    public function shopRepIndex()
    {
        $shop = auth()->user()->shop;
        $areas = ['#東京都','#大阪府','#福岡県'];
        $genres = ['#焼肉', '#居酒屋', '#寿司','#ラーメン', '#イタリアン'];

        return view('shop_rep.shop_rep_index', compact('shop', 'areas', 'genres'));
    }

    public function confirm(ShopRepRequest $request)
    {
        $shop = $request->all();

        return view('shop_rep.confirm', compact('shop'));
    }


    public function store(Request $request)
    {

        if ($request->has('back')) {
            return redirect('/shop/info')->withInput();
        }

        $user = auth()->user();

        Shop::create([
            'user_id' => $user->id,
            'shop_name' => $request->shop_name,
            'area' => $request->area,
            'genre' => $request->genre,
            'description' => $request->description,
            'image_url' => $request->image_url,
        ]);

        return view('shop_rep.done');
    }


    public function update(ShopRepRequest $request)
    {
        if ($request->has('back')) {
            return redirect('/shop/info')->withInput();
        }

        $shop = $request->only(['shop_name', 'area', 'genre', 'description', 'image_url']);
        Shop::find($request->id)->update($shop);


        return redirect()->route('shop_rep.shop_rep_index')->with('message', '店舗情報を変更しました');
    }


    public function reservations()
    {
        $reservations = auth()->user()->shop->reservations;

        return view('shop_rep.reservations', compact('reservations'));
    }
}
