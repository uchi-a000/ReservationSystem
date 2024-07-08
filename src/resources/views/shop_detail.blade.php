@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_detail.css') }}">

@endsection

@section('content')
<div class="shop-detail__container">
    <div class="shop-detail__inner">
        <div class="shop_detail__block">
            <div class="shop_detail__content">
                <a class="shop_detail__home-link" href="/">&lt;</a>
                <span class="shop_detail__ttl">{{ $shop->shop_name }}</span>
            </div>
            <div class="shop_detail__card__img">
                <img src="{{ $shop->image_url }}" alt="" />
            </div>
            <p class="shop_detail__item">{{ $shop->area }} {{ $shop->genre }}</p>
            <p class="shop_detail__item">{{ $shop->description }}</p>
        </div>

        <div class="reservation-form__block">
            <form class="reservation-form" action="/done" method="POST">
                @csrf
                <div class="reservation-form__ttl">予約</div>
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <div class="form__input-text">
                    <input type="date" name="reservation_date" id="date" value="" required />
                    <input type="time" name="reservation_time" id="time" value="17:00" required />
                    <select name="number_of_people" required>
                        <option value="1">1人</option>
                        <option value="2">2人</option>
                        <option value="3">3人</option>
                        <option value="4">4人</option>
                        <option value="5">5人</option>
                        <option value="6">6人</option>
                        <option value="8">8人</option>
                        <option value="9">9人</option>
                        <option value="10">10人</option>
                    </select>
                </div>

                @if(Auth::check())
                @if($reservations->isEmpty())
                <p>予約情報はありません</p>
                @else
                <div class="reservation-done__table">
                    <table class="reservation-done__table-inner">
                        <tr class="reservation-done__row">
                            <th class="reservation-done__header">Shop</th>
                            <td class="reservation-done__data">{{ $shop->shop_name }}</td>
                        </tr>
                        @foreach($reservations as $reservation)
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
                        @endforeach
                    </table>
                </div>
                @endif
                @else
                <p>ご予約はログインが必要です</p>
                @endif
                <div class="reservationーform__button">
                    <button class="reservationーform__button-submit" type="submit">予約する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection