@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/check_in.css') }}">
@endsection

@section('content')
<div class="check_in__container">
    <div class="check_in__inner">
        <h2 class="check_in__description">ご来店が確認されました</h2>
    </div>
</div>

@endsection