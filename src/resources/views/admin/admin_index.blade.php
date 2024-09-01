@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/admin_index.css') }}">
@endsection

@section('content')
<div class="admin__container">
    <div class="admin-notify-nav">
        <a class="admin-notify-nav__link" href="/admin/notify">利用者へお知らせメールはこちら</a>
    </div>
    <div class="admin__alert">
        @if(session('message'))
        <div class="admin__alert--success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <div class="admin__content">
        <h2 class="admin-ttl">店舗代表者登録</h2>
        <form class="admin-form" action="/admin/representatives" method="POST">
            @csrf
            <div class="admin-form__item">
                <input class="admin-form__item-input" type="text" name="name" placeholder="Username" value="{{ old('name') }}" />
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="admin-form__item">
                <input class="admin-form__item-input" type="email" name="email" placeholder="Email" value="{{ old('email') }}" />
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="admin-form__item">
                <input class="admin-form__item-input" type="password" name="password" placeholder="Password" />
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <button class="admin-form__btn btn">登録</button>
        </form>
    </div>
    <div class="shop-rep-list__content">
        <h2 class="shop-rep-list-ttl">店舗代表者一覧</h2>
        @if($representatives->isEmpty())
        <p>店舗代表者はいません</p>
        @else
        <table class="shop-rep-list__table">
            <thead>
                <tr class="shop-rep-list__row">
                    <th class="shop-rep-list__label">名前</th>
                    <th class="shop-rep-list__label">メールアドレス</th>
                </tr>
            </thead>
            <tbody>
                @foreach($representatives as $representative)
                <tr class="shop-rep-list__row">
                    <td class="shop-rep-list__data">{{ $representative->name }}</td>
                    <td class="shop-rep-list__data">{{ $representative->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection