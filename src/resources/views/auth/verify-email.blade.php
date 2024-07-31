@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
@endsection

@section('content')
<div class="content__head">
    <div class="content__head--inner">
        <h2 class="email__form">メールアドレスの確認</h2>
        <p class="email__form--content">会員登録ありがとうございます！
            <br /> ご登録アドレスにメールを送信しました。
            <br /> 利用を開始する前に、メールを確認し、指示に従ってアカウントを確認してください。
            <br />もしメールが届かない場合は、別のリンクを送信します。
        </p>

        @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success" role="alert" >
            メールアドレスへの確認用リンクを再送信しました。
        </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button class="email--form__submit" type="submit">確認メールを再送信</button>
        </form>
        <div class="register--form">
            <a class="register--form__btn" href="/register">会員登録画面へ</a>
        </div>
    </div>
</div>
@endsection