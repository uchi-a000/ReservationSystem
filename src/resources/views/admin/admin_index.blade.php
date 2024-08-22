@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_index.css') }}">
@endsection

@section('content')
<div class="admin__container">
    <div class="admin-nav__item">
        <a class="admin-nav__link" href="">店舗代表者一覧はこちら</a>
    </div>
    <div class="admin__alert">
        @if(session('message'))
        <div class="admin__alert--success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <h2 class="admin-ttl">店舗代表者作成</h2>
    <form class="admin-form" action="/admin/representatives" method="POST">
        @csrf
        <div class="admin-form__group">
            <input class="admin-form__group-input" type="text" name="name" placeholder="Username" value="{{ old('name') }}" />
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="admin-form__group">
            <input class="admin-form__group-input" type="email" name="email" placeholder="Email" value="{{ old('email') }}" />
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="admin-form__group">
            <input class="admin-form__group-input" type="password" placeholder="Password" name="password" />
            <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>
        <button class="admin-form__btn btn">登録</button>
    </form>

</div>
@endsection