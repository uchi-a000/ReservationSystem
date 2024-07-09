@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<script src="https://kit.fontawesome.com/748afbedc1.js" crossorigin="anonymous"></script>
@endsection

@section('content')

<div class="card_container">
    @foreach($shops as $shop)
    <div class="card__block">
        <div class="card__content">
            <div class="card__img">
                <img src="{{ $shop->image_url }}" alt="" />
            </div>
            <h2 class="card__content-ttl">{{ $shop->shop_name }}</h2>
            <div class="card__content-tag">
                <p class="card__content-tag-item">{{ $shop->area }} {{ $shop->genre }}</p>
            </div>
            <div class="shop-detail__content">
                <div class="shop-detail__content-inner">
                    <a class="" href="{{ route('shop_detail', $shop->id) }}">詳しく見る</a>
                    <div class="content__favorites-form">
                        @if(Auth::check() && Auth::user()->favorites->contains($shop))
                        <form action="{{ route('favorites', $shop->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="content__favorites-submit" type="submit" name="favorites_destroy">
                                <i class="fa-solid fa-heart" style="color: #FF0000;"></i>
                            </button>
                        </form>
                        @else
                        <form action="{{ route('favorites', $shop->id) }}" method="POST">
                            @csrf
                            <button class="content__favorites-submit" type="submit" name="favorites_store">
                                <i class=" fa-solid fa-heart" style="color: #ccc;"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection