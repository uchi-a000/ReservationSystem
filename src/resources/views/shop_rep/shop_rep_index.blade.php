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
                @error('area_id')
                {{ $message }}
                @enderror
            </div>
            <div class="item">
                <select class="select" name="area_id" id="area_id">
                    <option value="">エリアを選択してください</option>
                    @foreach($areas as $area)
                    <option value="{{ $area->id }}"
                    @if((request('area_id')==$area->id || old('area_id')==$area->id )) selected @endif>
                    {{ $area->area }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form__error">
                @error('genre_id')
                {{ $message }}
                @enderror
            </div>
            <div class="item">
                <select class="select" name="genre_id" id="genre_id">
                    <option value="">ジャンルを選択してください</option>
                    @foreach($genres as $genre)
                    <option value="{{ $genre->id }}"
                    @if((request('genre_id')==$genre->id || old('genre_id')==$genre->id )) selected @endif>
                    {{ $genre->genre }}
                    </option>
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
                @error('image')
                {{ $message }}
                @enderror
            </div>
            <div class="item">
                <input class="file" type="file" name="image" accept="image/*" />
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
                @error('area_id')
                {{ $message }}
                @enderror
            </div>
            <div class="item">
                <select class="select" name="area_id">
                    <option value="{{ $shop->area->id }}">{{ $shop->area->area }}</option>

                    <!-- 他のエリアを選択肢として表示 -->
                    @foreach($areas as $area)
                    @if($area->id !== $shop->area->id)
                    <option value="{{ $area->id }}"
                        @if((request('area_id')==$area->id || old('area_id') == $area->id)) selected @endif>
                        {{ $area->area }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form__error">
                @error('genre_id')
                {{ $message }}
                @enderror
            </div>
            <div class="item">
                <select class="select" name="genre_id">
                    <option value="{{ $shop->genre->id }}">{{ $shop->genre->genre }}</option>

                    <!-- 他のジャンルを選択肢として表示 -->
                    @foreach($genres as $genre)
                    @if($genre->id !== $shop->genre->id)
                    <option value="{{ $genre->id }}"
                        @if((request('genre_id')==$genre->id || old('genre_id') == $genre->id)) selected @endif>
                        {{ $genre->genre }}
                    </option>
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
                @error('image')
                {{ $message }}
                @enderror
            </div>
            <div class="item">
                <input class="file" type="file" name="image" accept="image/*" />
            </div>

            <div class="update-from__btn">
                <input type="hidden" name="id" value="{{ $shop->id }}">
                <input type="hidden" name="user_id" value="{{ $shop->user_id }}">
                <button class="form__btn">変更</button>
            </div>
        </form>
    </div>
    @endif
</div>
@endsection