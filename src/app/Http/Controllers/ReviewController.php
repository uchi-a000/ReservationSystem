<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\Reservation;

class ReviewController extends Controller
{
    // public function review(ReviewRequest $request)
    // {
    //     $reservations = Reservation::find($request->reservation_id);

    //     $reviews = Review::create([
    //         'user_id' => auth()->id(),
    //         'shop_id' => $request->shop_id,
    //         'reservation_id' => $request->reservation_id,
    //         'rating' => $request->rating,
    //         'comment' => $request->comment,
    //     ]);

    //     return redirect()->route('my_page')->with('success', '口コミを投稿しました');
    // }
}
