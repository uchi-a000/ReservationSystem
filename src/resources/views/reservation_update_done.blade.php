@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation_update_done.css') }}">
@endsection

@section('content')
<div class="reservation_update_done-page">
    <div class="done-page__inner">
        <p class="done-page__message">変更が完了しました</p>
        <a class="back_btn" href="/mypage">戻る</a>
    </div>
</div>
@endsection