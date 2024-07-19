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
                        <div class="shop__container">
                            <div class="shop__inner">
                                @if(isset($favorites) && $favorites->isNotEmpty())
                                @foreach($favorites as $favorite)
                                <div class="shop__block">
                                    <div class="shop__img"><img src="{{ $favorite->shop->image_url }}" alt="" /></div>
                                    <div class="shop__card-content">
                                        <h2 class="shop__card-ttl">{{ $favorite->shop_name }}</h2>
                                        <p class="shop__tag">{{ $favorite->shop->area }} {{ $favorite->shop->genre }}</p>
                                        <div class="shop-detail__form">
                                            <div class="shop-detail__inner">
                                                <a class="shop-detail__form btn" href="{{ route('shop_detail', $favorite->shop->id) }}">詳しくみる</a>
                                                <form class="favorites__form" action="{{ route('favorites', $favorite->shop->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="favorites-submit" type="submit" name="favorites_destroy">
                                                        <img src="{{ asset('icon/red_heart.svg')}}" alt="" style="width: 35px; height: 35px;">
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <p>該当する店舗が見つかりませんでした。</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection