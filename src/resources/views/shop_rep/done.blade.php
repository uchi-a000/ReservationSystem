@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_rep/done.css') }}">
@endsection

@section('content')
<div class="done-page">
    <div class="done-page__inner">
        <p class="done-page__message">ご登録が完了しました</p>
        <form class="done-page__form" action="/home" method="get">
            <button class="dome-page__btn btn">戻る</button>
        </form>
    </div>
</div>
@endsection