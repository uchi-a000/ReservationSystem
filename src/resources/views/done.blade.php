@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="done-page">
    <div class="done-page__inner">
        <p class="done-page__message">ご予約ありがとうございます</p>
        <form class="done-page__form" action="/home" method="get">
            <button class="dome-page__btn btn">戻る</button>
        </form>
    </div>
</div>

@endsection