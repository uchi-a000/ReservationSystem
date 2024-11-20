@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reviews_index.css') }}">
@endsection

@section('content')
<div class="reviews__container">
    <div class="reviews__inner">
        <div class="alert">
            @if(session('success'))
            <div class="delete-alert">
                {{ session('success') }}
            </div>
            @endif
        </div>
        @if($reviews->isNotEmpty())
        <h1>{{ $reviews->first()->shop->shop_name }} の口コミ一覧</h1>

        @foreach($reviews as $review)
        <div class="reviews__table">
            <table class="reviews__table-inner">
                <tr class="reviews__row">
                    <th class="reviews__header">評価</th>
                    <td class="reviews__data">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <=$review->rating)
                            <span class="filled-star">★</span>
                            @else
                            <span class="empty-star">☆</span>
                            @endif
                            @endfor
                    </td>
                </tr>
                <tr class="reviews__row">
                    <th class="reviews__header">ユーザー名</th>
                    <td class="reviews__data">{{ $review->user->name }}さん</td>
                </tr>
                <tr class="reviews__row">
                    <th class="reviews__header">コメント</th>
                    <td class="reviews__data">{{ $review->comment }}</td>
                </tr>
                <tr class="reviews__row">
                    <th class="reviews__header">画像</th>
                    <td class="reviews__data">
                        @if ($review->images && is_array(json_decode($review->images, true)))
                        @foreach (json_decode($review->images, true) as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="口コミ画像" width="100">
                        @endforeach
                        @else
                        なし
                        @endif
                    </td>
                </tr>
                @if(Auth::check() && Auth::user()->hasRole('admin'))
                <tr class="reviews__row">
                    <th class="reviews__header"></th>
                    <td class="reviews__data">
                        <form action="{{ route('reviews_destroy', $review->id) }}" method="POST" onclick="return confirm('本当に削除しますか？')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete_btn">削除する</button>
                        </form>
                    </td>
                </tr>
                @endif
            </table>
        </div>
        @endforeach
        @else
        <p style="font-size: 30px;">口コミはまだありません</p>
        @endif
    </div>
</div>
@endsection