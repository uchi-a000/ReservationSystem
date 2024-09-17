@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stripe/cancel.css') }}">
@endsection

@section('content')
<div class="cancel">
    <h1>Payment Cancelled</h1>
    <p>お支払いがキャンセルされました。</p>
    <a class="back_btn" href="/mypage">戻る</a>
</div>
@endsection