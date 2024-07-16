@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">

@endsection

@section('content')
<div class="mypage-container">
    <h2 class="mypage__alert heading">{{ Auth::user()->name }} さん</h2>

    <div class="mypage">
        <div class="mypage__inner">
            <form class="mypage-form" action="/mypage" method="GET">
                @csrf
                <div class="information-ttl">
                    <h3 class="reservation__ttl">予約状況</h3>
                    <h3 class="favorite__ttl">お気に入り店舗</h3>
                </div>
                <div class="information__block">
                    <div class="information__inner">
                        <!-- 予約状況 -->
                        @if($reservations->isEmpty())
                        <p>予約情報はありません</p>
                        @else
                        @foreach($reservations as $reservation)
                        <div class="reservation-done__table">
                            <table class="reservation-done__table-inner">
                                <tr class="reservation-done__row">
                                    <th class="reservation-done__label">Shop</th>
                                    <td class="reservation-done__data">{{ $reservation->shop->shop_name }}</td>
                                </tr>
                                <tr class="reservation-done__row">
                                    <th class="reservation-done__label">Date</th>
                                    <td class="reservation-done__data">{{ $reservation->reservation_date }}</td>
                                </tr>
                                <tr class="reservation-done__row">
                                    <th class="reservation-done__label">Time</th>
                                    <td class="reservation-done__data">{{ substr( $reservation->reservation_time, 0, 5) }}</td>
                                </tr>
                                <tr class="reservation-done__row">
                                    <th class="reservation-done__label">Number</th>
                                    <td class="reservation-done__data">{{ $reservation->number_of_people }}</td>
                                </tr>
                            </table>
                        </div>
                        @endforeach
                        @endif

                        <!-- お気に入り店舗 -->
                        @if($favorites->isEmpty())
                        <p>お気に入り店舗はありません</p>
                        @else
                        @foreach($favorites as $favorite)
                        <div class="favorite__content">
                            <div class="favorite__img"><img src="{{ $favorite->shop->image_url }}" alt="" /></div>
                            <h2 class="favorite__ttl">{{ $favorite->shop->shop_name }}</h2>
                            <p class="favorite_tag">{{ $favorite->shop->area }} {{ $favorite->shop->genre }}</p>
                            <div class="shop-detail__form">
                                <div class="shop-detail__inner">
                                    <a class="shop-detail__link" href="{{ route('shop_detail', $favorite->shop->id) }}">詳しく見る</a>
                                    <form class="favorites__form" action="{{ route('favorites', $favorite->shop->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="favorites-submit" type="submit" name="favorites">
                                            <i class="fa-solid fa-heart" style="color: #FF0000;"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection