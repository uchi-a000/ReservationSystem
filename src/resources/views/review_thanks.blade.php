@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review_thanks.css') }}">

@endsection

@section('content')
<div class="review-thanks__container">
    <h2 class="review-thanks__text">口コミ投稿ありがとうございました！<br>投稿が完了しました</h2>
    <div class="my_page__link">
        <a class="my_page__link__btn" href="/mypage">マイページへ戻る</a>
    </div>
</div>
    @endsection