@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/generate_qr_code.css') }}">

@endsection

@section('content')
<div class="qr-code__container">
    <div class="qr-code__inner">
        <h2 class="qr-code__description">ご来店確認</h2>
        <p class="">以下QRコードをご予約店舗にお見せください</p>
        <div class="qr-code">
            {!! $qrCodes[$reservation->id] !!}
        </div>
        <div class="my_page__link">
            <a class="my_page__link__btn" href="/mypage">マイページへ戻る</a>
        </div>
    </div>
</div>
@endsection