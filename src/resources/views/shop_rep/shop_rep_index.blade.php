@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_rep/shop_rep_index.css') }}">
@endsection

@section('content')
<div class="shop-rep__container">
    <div class="shop-rep-nav__item">
        @if($status == 1)
        <a class="shop-rep-nav__link" href="/shop/reservations">予約情報はこちら</a>
        @endif
    </div>
    <div class="shop-rep__alert">
        @if(session('message'))
        <div class="shop-rep__alert--success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    @if(!$shop)
    <div class="registration__content">
        <h2 class="registration-ttl">店舗情報登録</h2>
        <form class="form" action="/shop/confirm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form__error">
                @error('shop_name')
                {{ $message }}
                @enderror
            </div>
            <div class="item">
                <input class="input" type="text" name="shop_name" placeholder="店舗名を入力してください" value="{{ old('shop_name') }}" />
            </div>
            <div class="form__error">
                @error('area')
                {{ $message }}
                @enderror
            </div>
            <div class="item">
                <select class="select" name="area">
                    <option value="" @if( request('areas')=='' ) selected @endif>エリアを選択してください</option>
                    @foreach($areas as $area)
                    <option value="{{ $area }}" @if((request('area')==$area || old('area')==$area )) selected @endif>{{ $area }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form__error">
                @error('genre')
                {{ $message }}
                @enderror
            </div>
            <div class="item">
                <select class="select" name="genre">
                    <option value="" @if( request('genres')=='' ) selected @endif>ジャンルを選択してください</option>
                    @foreach($genres as $genre)
                    <option value="{{ $genre }}" @if((request('genre')==$genre || old('genre')==$genre )) selected @endif>{{ $genre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form__error">
                @error('description')
                {{ $message }}
                @enderror
            </div>
            <div class="item">
                <textarea class="textarea" name="description" placeholder="50~150文字以内でお店の説明を入力してください">{{ old('description') }}</textarea>
            </div>
            <div class="form__error">
                @error('image_url')
                {{ $message }}
                @enderror
            </div>
            <div class="item">
                <input class="file" type="file" name="image_url" accept="image/*" />
            </div>
            <button class="form__btn">登録</button>
        </form>
    </div>
    @else
    <div class="update__content">
        <h2 class="update-ttl">店舗情報変更</h2>
        <form class="form" action="{{ route('shop_rep.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="form__error">
                @error('shop_name')
                {{ $message }}
                @enderror
            </div>
            <div class="item">
                <input class="input" type="text" name="shop_name" value="{{ $shop->shop_name }}" />
            </div>
            <div class="form__error">
                @error('area')
                {{ $message }}
                @enderror
            </div>
            <div class="item">
                <select class="select" name="area">
                    <option>{{ $shop->area }}</option>
                    @foreach($areas as $area)
                    @if($area !== $shop->area )
                    <option value="{{ $area }}" @if((request('area')==$area || old('area')==$area )) selected @endif>{{ $area }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form__error">
                @error('genre')
                {{ $message }}
                @enderror
            </div>
            <div class="item">
                <select class="select" name="genre">
                    <option>{{ $shop->genre }}</option>
                    @foreach($genres as $genre)
                    @if($genre !== $shop->genre )
                    <option value="{{ $genre }}" @if((request('genre')==$genre || old('genre')==$genre )) selected @endif>{{ $genre }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form__error">
                @error('description')
                {{ $message }}
                @enderror
            </div>
            <div class="item">
                <textarea class="textarea" name="description">{{ $shop->description }}</textarea>
            </div>
            <div class="form__error">
                @error('image_url')
                {{ $message }}
                @enderror
            </div>
            <div class="item">
                <input class="file" type="file" name="image_url" accept="image/*" />
            </div>

            <div class="confirm-modal-update">
                <a class="confirm-modal__link" href="#confirm-modal-{{ $shop->id }}">変更</a>
            </div>
            <div class="confirm-modal" id="confirm-modal-{{ $shop->id }}">
                <a href="#!" class="confirm-modal-overlay"></a>
                <div class="confirm-modal__inner">
                    <div class="confirm-modal__content">
                        <h3>変更してよろしいですか？</h3>
                        <input type="hidden" name="id" value="{{ $shop->id }}">
                        <input type="hidden" name="user_id" value="{{ $shop->user_id }}">
                        <button class="confirm-modal__btn" type="submit">変更する</button>
                        <a href="#" class="confirm-modal__close__btn">戻る</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endif
</div>
@endsection