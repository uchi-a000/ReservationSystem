@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/notify.css') }}">
@endsection

@section('content')
<div class="notify__container">
    <div class="notify__heading">
        <a class="representatives-link" href="/admin/representatives">&lt;</a>
        <h2>お知らせメール作成</h2>
    </div>
    <div class="notify__alert">
        @if(session('message'))
        <div class="notify__alert--success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <form action="{{ route('admin.notify.confirm') }}" method="POST">
        @csrf
        <div class="form__error">
            @error('subject')
            {{ $message }}
            @enderror
        </div>
        <div class="form__group">
            <label class="form__label" for="subject">件名</label>
            <input type="text" name="subject" id="subject" class="subject" value="{{ old('subject') }}">
        </div>
        <div class="form__error">
            @error('message')
            {{ $message }}
            @enderror
        </div>
        <div class="form__group">
            <label class="form__label" for="message">本文</label>
            <textarea name="message" id="message" class="message">{{ old('message') }}</textarea>
        </div>
        <button type="submit" class="notify__btn">内容確認</button>
    </form>
</div>
@endsection