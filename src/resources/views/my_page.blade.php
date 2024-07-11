@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">

@endsection

@section('content')
<div class="mypage-container">
    <h2 class="mypage-alert heading">{{ Auth::user()->name }} さん</h2>
    <!-- 予約状況 -->
    <div class="mypage-panel">
        <div class="mypage-panel__inner">
            <form class="mypage-form" action="/mypage" method="GET">
                @csrf
                <div class="mypage-reservation__block">
                    @if($reservation)
                    <div class="reservation-done__table">
                        <table class="reservation-done__table-inner">
                            <tr class="reservation-done__row">
                                <th class="reservation-done__header">Shop</th>
                                <td class="reservation-done__data">{{ $reservation->shop->shop_name }}</td>
                            </tr>
                            <tr class="reservation-done__row">
                                <th class="reservation-done__header">Date</th>
                                <td class="reservation-done__data">{{ $reservation->reservation_date }}</td>
                            </tr>
                            <tr class="reservation-done__row">
                                <th class="reservation-done__header">Time</th>
                                <td class="reservation-done__data">{{ substr( $reservation->reservation_time, 0, 5) }}</td>
                            </tr>
                            <tr class="reservation-done__row">
                                <th class="reservation-done__header">Number</th>
                                <td class="reservation-done__data">{{ $reservation->number_of_people }}</td>
                            </tr>
                        </table>
                    </div>
                    @endif
                </div>
                <!-- お気に入り店舗 -->
                @foreach($favorites as $favorite)
                <div class="mypage-favorite__block">
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
                </div>
                @endforeach
            </form>
        </div>
    </div>
</div>
@endsection