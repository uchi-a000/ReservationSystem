<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\shop;

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
}
