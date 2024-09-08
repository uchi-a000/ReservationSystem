@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-page">
    <div class="thanks-page__inner">
        <p class="thanks-page__message">認証が完了しました</p>
        <form class="thanks-page__form" action="/home" method="get">
            <button class="thanks-page__btn btn">home</button>
        </form>
    </div>
</div>
@endsection