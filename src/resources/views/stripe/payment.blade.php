@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stripe/payment.css') }}">
@endsection

@section('content')
<div class="payment">
    @if (session('error'))
    <div class="error__alert">{{ session('error') }}</div>
    @endif
    <h1>店舗名: {{ $reservation->shop->shop_name }}</h1>
    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
        <div class="form__error">
            @error('amount')
            {{ $message }}
            @enderror
        </div>
        <label class="amount" for="amount">金額:</label>
        <input class="number" type="number" name="amount" id="amount" value="{{ old('amount') }}">
        <div>
            <button class="submit" type="submit">Stripe決済</button>
            <a class="back_btn" href="/mypage">戻る</a>
        </div>

    </form>
</div>
@endsection