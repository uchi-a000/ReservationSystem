@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-page">
    <div class="thanks-page__inner">
        <p class="thanks-page__message">会員登録ありがとうございます</p>
        <form class="thanks-page__form" action="/login" method="get">
            <button class="thanks-page__btn btn">ログインする</button>
        </form>
    </div>
</div>
@endsection