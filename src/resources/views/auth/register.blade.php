@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register__container">
    <div class="register__inner">
        <div class="register-form__heading">
            <h2>Registration</h2>
        </div>
        <form class="register-form" action="/register" method="post">
            @csrf
            <div class="form__group">
                <div class="form__input-name">
                    <input class="form__input-text" type="text" name="name" placeholder="Username" value="{{ old('name') }}" />
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__input-mail">
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
                    <input class="form__input-text" type="password" placeholder="Password" name="password" />
                </div>
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <input class="register-form__btn btn" type="submit" value="登録">
        </form>
    </div>
</div>
@endsection