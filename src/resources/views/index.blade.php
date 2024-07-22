@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<script src="https://kit.fontawesome.com/748afbedc1.js" crossorigin="anonymous"></script>
@endsection

@section('content')
<div class="shop__container">
    <div class="shop__inner">
        @if(isset($shops) && $shops->isNotEmpty())
        @foreach($shops as $shop)
        <div class="shop__block">
            <div class="shop__img"><img src="{{ $shop->image_url }}" alt="" /></div>
            <div class="shop__card-content">
                <h4 class="shop__card-ttl">{{ $shop->shop_name }}</h4>
                <p class="shop__tag">{{ $shop->area }} {{ $shop->genre }}</p>
                <div class="shop-detail__form">
                    <div class="shop-detail__inner">
                        <a class="shop-detail__form btn" href="{{ route('shop_detail', $shop->id) }}">詳しくみる</a>
                        @if(Auth::check() && Auth::user()->favorites->contains($shop))
                        <form class="favorites__form" action="{{ route('favorites', $shop->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="favorites-submit" type="submit" name="favorites_destroy">
                                <img src="{{ asset('icon/red_heart.svg')}}" alt="" style="width: 35px; height: 35px;">
                            </button>
                        </form>
                        @else
                        <form class="favorites__form" action="{{ route('favorites', $shop->id) }}" method="POST">
                            @csrf
                            <button class="favorites-submit" type="submit" name="favorites_store">
                                <img src="{{ asset('icon/gray_heart.svg')}}" alt="" style="width: 35px; height: 35px;">
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
</div>
@endsection