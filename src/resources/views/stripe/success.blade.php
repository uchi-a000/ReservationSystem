@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment/success.css') }}">
@endsection

@section('content')
<div class="success">
    <h1>Payment Successful!</h1>
    <p>お支払い完了しました。<br> ご利用ありがとうございました。</p>
    <p>口コミ投稿お待ちしてます！</p>
    <a class="back_btn" href="/mypage">戻る</a>
</div>
@endsection