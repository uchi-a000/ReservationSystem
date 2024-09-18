@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation_update.css') }}">
@endsection

@section('content')
<div class="reservation-update">
    <form class="update-form" action="{{ route('reservation_update_done', $reservation->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="update__content">
            <p class="update__text">必要な箇所を変更してください</p>
            <div class="update-form__item">
                <label for="label">年月日：</label>
                <input class="update-form__item__input" type="date" name="reservation_date" value="{{ $reservation->reservation_date }}">
                <div class="form__error">
                    @error('reservation_date')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="update-form__item">
                <label for="label" style="margin-left: 15px;">時間：</label>
                <input class="update-form__item__input" type="time" name="reservation_time" value="{{ substr($reservation->reservation_time, 0, 5) }}">
                <div class="form__error">
                    @error('reservation_time')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="update-form__item">
                <label for="label" style="margin-left: 15px;">人数：</label>
                <input class="update-form__item__input" type="number" name="number_of_people" value="{{ $reservation->number_of_people }}" min="1">
                <div class="form__error">
                    @error('number_of_people')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <button class="update__btn" type="submit">変更</button>
            <a href="/mypage" class="back__btn">戻る</a>
        </div>
    </form>

</div>
@endsection