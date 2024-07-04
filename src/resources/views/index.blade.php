@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
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
                <a class="" href="{{ route('shop_detail', $shop->id) }}">詳しく見る</a>
            </div>
        </div>
    </div>

    @endforeach
</div>
@endsection