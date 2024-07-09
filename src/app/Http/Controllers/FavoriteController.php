<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\shop;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
    public function toggleFavorite(Shop $shop)
    {
        $user = auth()->user();
        $favorite = Favorite::where('user_id', $user->id)
                            ->where('shop_id', $shop->id)
                            ->first();

        if ($favorite) {
            $favorite->delete();
            return redirect()->back();
        } else {
            $favorite = new Favorite();
            $favorite->user_id = $user->id;
            $favorite->shop_id = $shop->id;
            $favorite->save();

            return redirect()->back();
        }
    }

}
