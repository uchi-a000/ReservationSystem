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
    <div class="shop-reo__content">
        <h2 class="shop-rep-ttl">店舗情報登録</h2>
        <form class="shop-rep-form" action="/shop/confirm" method="POST">
            @csrf
            <div class="form__error">
                @error('shop_name')
                {{ $message }}
                @enderror
            </div>
            <div class="shop-rep__item">
                <label class="shop-rep__item-label" for="shop_name">店舗名:</label>
                <input class="shop-rep__item-input" type="text" name="shop_name" placeholder="店舗名を入力してください" value="{{ old('shop_name') }}" />
            </div>
            <div class="form__error">
                @error('area')
                {{ $message }}
                @enderror
            </div>
            <div class="shop-rep__item">
                <label class="shop-rep__item-label" for="area">エリア:</label>
                <select class="shop-rep__item-select" name="area">
                    <option class="shop-rep__item-option" value="" @if( request('areas')=='' ) selected @endif>選択してください</option>
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
            <div class="shop-rep__item">
                <label class="shop-rep__item-label" for="genre">ジャンル:</label>
                <select class="shop-rep__item-select" name="genre">
                    <option class="shop-rep__item-option" value="" @if( request('genres')=='' ) selected @endif>選択してください</option>
                    @foreach($genres as $genre)
                    <option class="shop-rep__item-option" value="{{ $genre }}" @if((request('genre')==$genre || old('genre')==$genre )) selected @endif>{{ $genre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form__error">
                @error('description')
                {{ $message }}
                @enderror
            </div>
            <div class="shop-rep__item">
                <label class="shop-rep__item-label" for="description">説明:</label>
                <textarea class="update__item-textarea" name="description" placeholder="50~150文字以内で入力してください">{{ old('description') }}</textarea>
            </div>
            <div class="form__error">
                @error('image_url')
                {{ $message }}
                @enderror
            </div>
            <div class="shop-rep__item">
                <label class="shop-rep__item-label" for="image_url">画像:</label>
                <input class="shop-rep__item-input" type="text" name="image_url" placeholder="画像のURLを貼り付けてください" value="{{ old('image_url') }}" />
            </div>
            <button class="shop-rep-form__btn btn">登録</button>
        </form>
    </div>
    @else
    <div class="update__content">
        <h2 class="update-ttl">店舗情報変更</h2>
        <form class="confirm--modal-form" action="{{ route('shop_rep.update', $shop->id) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="form__error">
                @error('shop_name')
                {{ $message }}
                @enderror
            </div>
            <div class="update__item">
                <label class="update__item-label" for="shop_name">店舗名:</label>
                <input class="update__item-input" type="text" name="shop_name" value="{{ $shop->shop_name }}" />
            </div>
            <div class="form__error">
                @error('area')
                {{ $message }}
                @enderror
            </div>
            <div class="update__item">
                <label class="update__item-label" for="area">エリア:</label>
                <select class="update__item-select" name="area">
                    <option class="update__item-option">{{ $shop->area }}</option>
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
            <div class="update__item">
                <label class="update__item-label" for="genre">ジャンル:</label>
                <select class="update__item-select" name="genre">
                    <option class="update__item-option">{{ $shop->genre }}</option>
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
            <div class="update__item">
                <label class="update__item-label" for="description">説明:</label>
                <textarea class="update__item-textarea" name="description">{{ $shop->description }}</textarea>
            </div>
            <div class="form__error">
                @error('image_url')
                {{ $message }}
                @enderror
            </div>
            <div class="update__item">
                <label class="update__item-label" for="image_url">画像:</label>
                <input class="update__item-input" type="text" name="image_url" value="{{ $shop->image_url }}" />
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