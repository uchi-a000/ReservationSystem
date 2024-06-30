<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\shop;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::all();

        return view('index', compact('shops'));
    }

    public function shop_detail(Request $request)
    {
        $detail = Shop::find($request->id);

        return view('shop_detail', compact('detail'));
    }
}
