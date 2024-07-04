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
            <form class="reservation-form" action="/done" method="post">
                @csrf
                <div class="reservation-form__ttl">予約</div>
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <div class="form__input-text">
                    <input type="date" name="date" id="date" value="{{ $reservationDate }}" />
                    <input type="time" name="time" id="time" value="{{ $reservationDate }}" />
                    <select name="number_of_people">
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
                <div class="reservation-form__table">
                    <table class="reservation-form__table-inner">
                        <tr class="reservation-form__row">
                            <th class="reservation-form__header">Shop</th>
                            <td class="reservation-form__data">{{ $shop->shop_name }}</td>
                        </tr>
                        <tr class="reservation-form__row">
                            <th class="reservation-form__header">Date</th>
                            <td class="reservation-form__data"></td>
                        </tr>
                        <tr class="reservation-form__row">
                            <th class="reservation-form__header">Time</th>
                            <td class="reservation-form__data"></td>
                        </tr>
                        <tr class="reservation-form__row">
                            <th class="reservation-form__header">Number</th>
                            <td class="reservation-form__data"></td>
                        </tr>
                    </table>
                </div>
                <div class="reservationーform__button">
                    <button class="reservationーform__button-submit" type="submit">予約する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection