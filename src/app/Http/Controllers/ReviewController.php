<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Review;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{
    public function index($shop_id)
    {
        $reviews = Review::with('shop')->where('shop_id', $shop_id)->get();

        return view('reviews_index', compact('reviews'));
    }


    public function review($id)
    {
        $user_id = Auth::id();
        $review = Review::find($id);
        $reservation = Reservation::where('user_id', $user_id)
                        ->where('id', $id)
                        ->with('shop')
                        ->first();
        $favorites = Favorite::where('user_id', $user_id)->pluck('shop_id');

        return view('review', compact('review', 'reservation', 'favorites'));
    }

    public function reviewThanks(ReviewRequest $request)
    {
        $images = null;
        $uploadedImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $uploadedImages[] = $file->store('reviews', 'public');
            }
        }

        if(!empty($uploadedImages)){
            $images = json_encode($uploadedImages);
        }

        Review::create([
            'user_id' => auth()->id(),
            'shop_id' => $request->shop_id,
            'reservation_id' => $request->reservation_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'images' => $images,
        ]);

        return view('review_thanks');
    }

    public function showUpdate($id)
    {
        $user_id = Auth::id();
        $review = Review::with('shop')->find($id);
        $favorites = Favorite::where('user_id', $user_id)->pluck('shop_id');

        return view('review_update', compact('review', 'favorites'));
    }

    public function update(ReviewRequest $request)
    {
        $review = Review::find($request->id);

        // 既存の画像があれば、それを取り出して配列に格納
        $existing_images = $review->images ? json_decode($review->images, true) : [];

        // 新しくアップロードされた画像のパスを格納する配列
        $images = $existing_images;

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('reviews', 'public');
            }
        }

         // $review_dataを初期化する
        $review_data = [
            'images' => !empty($images) ? json_encode($images) : null,
        ];


        $review_data = array_merge($review_data, $request->only(['rating', 'comment']));

        $review->update($review_data);

        return redirect()->route('review_update', ['id' => $review->id])->with('message', '口コミを変更しました');
    }


    public function deleteReview($review_id, $shop_id)
    {
        $review = Review::find($review_id);

        $review->delete();

        return redirect()->route('shop_detail', ['shop_id' => $shop_id])->with('message', '口コミを削除しました');
    }

}
