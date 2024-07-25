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
            <div class="shop_detail__card-img">
                <img src="{{ $shop->image_url }}" alt="" />
            </div>
            <p class="shop_detail__item">{{ $shop->area }} {{ $shop->genre }}</p>
            <p class="shop_detail__description">{{ $shop->description }}</p>
        </div>

        <!-- 予約情報入力ページ -->
        <div class="reservation-form__block">
            <form class="reservation-form" action="/done" method="POST">
                @csrf
                <div class="reservation-form__ttl">予約</div>
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <div class="reservation-formーdate">
                    <div class="form__error">
                        @error('reservation_date')
                        {{ $message }}
                        @enderror
                    </div>
                    <input class="reservation-formーdate__input" type="date" name="reservation_date" value="{{ old('reservation_date') }}" />
                </div>

                <div class="reservation-formーtime">
                    <div class="form__error">
                        @error('reservation_time')
                        {{ $message }}
                        @enderror
                    </div>
                    <input class="reservation-formーtime__input" type="time" name="reservation_time" value="{{ old('reservation_time', '17:00') }}" />
                </div>
                <div class="reservation-formーnumber_of_people">
                    <div class="form__error">
                        @error('number_of_people')
                        {{ $message }}
                        @enderror
                    </div>
                    <select class="number_of_people__select" name="number_of_people">
                        @foreach($numberOfPeopleOptions as $option)
                        <option value="{{ $option }}">{{ $option }}人</option>
                        @endforeach
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
                            <td class="reservation-done__data">{{ $reservation->number_of_people }}人</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @endif
                @else
                <p>ご予約はログインが必要です</p>
                @endif
                <button class="form__btn btn" type="submit">予約する</button>
            </form>
        </div>
    </div>
</div>
@endsection