@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__container">
    <div class="login__inner">
        <div class="login-form__heading">
            <h2>Login</h2>
        </div>
        <form class="login-form" action="/login" method="post">
            @csrf
            <div class="form__group">
                <div class="form__input-email">
                    <input class="form__input-text" type="email" name="email" placeholder="Email" value="{{ old('email') }}" />
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__input-password">
                    <input class="form__input-text" type="password" placeholder="password" name="password" />
                </div>
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <button class="login-form__btn btn">ログイン</button>
        </form>
    </div>
</div>
@endsection