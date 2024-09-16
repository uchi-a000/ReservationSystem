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
                @if(Storage::disk('public')->exists('images/' . $shop['image_url']))
                <img src="{{ Storage::url('images/' . $shop['image_url']) }}" alt="ストレージ画像">
                @else
                <img src="{{ $shop->image_url }}" alt="ダミー画像" />
                @endif
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
                    <input class="date__input" type="date" name="reservation_date" value="{{ old('reservation_date') }}" />
                </div>

                <div class="reservation-formーtime">
                    <div class="form__error">
                        @error('reservation_time')
                        {{ $message }}
                        @enderror
                    </div>
                    <select class="time__select" name="reservation_time">
                        <option value="">時間を選択してください</option>
                        @foreach($timeOptions as $time)
                        <option value="{{ $time }}" @if( old('reservation_time')==$time )selected @endif>{{ $time }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="reservation-formーnumber_of_people">
                    <div class="form__error">
                        @error('number_of_people')
                        {{ $message }}
                        @enderror
                    </div>
                    <select class="number_of_people__select" name="number_of_people">
                        <option value="">人数を選択してください</option>
                        @foreach($numberOfPeopleOptions as $option)
                        <option value="{{ $option }}" @if( old('number_of_people')==$option )selected @endif>{{ $option }}人</option>
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
                <div class="form__btn">
                    <button class="btn" type="submit">予約する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection