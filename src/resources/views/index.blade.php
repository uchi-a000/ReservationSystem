@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<script src="https://kit.fontawesome.com/748afbedc1.js" crossorigin="anonymous"></script>
@endsection

@section('content')
<div class="home__container">
    @if(isset($shops) && $shops->isNotEmpty())
    @foreach($shops as $shop)
    <div class="home-shop__block">
        <div class="home-shop__inner">
            <div class="shop__img"><img src="{{ $shop->image_url }}" alt="" /></div>
            <h2 class="shop__ttl">{{ $shop->shop_name }}</h2>
            <div class="shop__tag">
                <p class="shop__tag-item">{{ $shop->area }} </p>
                <p class="shop__tag-item">{{ $shop->genre }} </p>
            </div>
            <div class="shop-detail__form">
                <div class="shop-detail__inner">
                    <a class="shop-detail__form" href="{{ route('shop_detail', $shop->id) }}">詳しく見る</a>
                    @if(Auth::check() && Auth::user()->favorites->contains($shop))
                    <form class="favorites__form" action="{{ route('favorites', $shop->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="favorites-submit" type="submit" name="favorites_destroy">
                            <i class="fa-solid fa-heart" style="color: #FF0000;"></i>
                        </button>
                    </form>
                    @else
                    <form class="favorites__form" action="{{ route('favorites', $shop->id) }}" method="POST">
                        @csrf
                        <button class="favorites-submit" type="submit" name="favorites_store">
                            <i class=" fa-solid fa-heart" style="color: #ccc;"></i>
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <p>該当する店舗が見つかりませんでした。</p>
    @endif
</div>
@endsection