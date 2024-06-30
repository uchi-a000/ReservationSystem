@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
@endsection

@section('content')
<!-- <ul class="header-nav">
    @if (Auth::check())
    <li class="header-nav__item">
        <a class="header-nav__link" href="/mypage">マイページ</a>
    </li>
    <li class="header-nav__item">
        <form action="/logout" method="post">
            @csrf
            <button class="header-nav__button">ログアウト</button>
        </form>
    </li>
    @endif
</ul> -->
@endsection