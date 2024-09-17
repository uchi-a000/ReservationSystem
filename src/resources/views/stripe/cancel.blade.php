@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stripe/cancel.css') }}">
@endsection

@section('content')
<div class="cancel">
    <div class="cancel__inner">
        <h1>Payment Cancelled</h1>
        <p class="message">お支払いをキャンセルしました</p>
        <a class="back_btn" href="/mypage">戻る</a>
    </div>
</div>
@endsection