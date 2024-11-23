@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_rep/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h2>ご登録内容確認</h2>
    </div>
    <form class="form" action="/shop/done" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">店舗名</th>
                    <td class="confirm-table__text">{{ $shops['shop_name'] }}</td>
                    <input type="hidden" name="shop_name" value="{{ $shops['shop_name'] }}" />
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">エリア</th>
                    <td class="confirm-table__text">{{ $area->area }}</td>
                    <input type="hidden" name="area_id" value="{{ $shops['area_id'] }}">
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">ジャンル</th>
                    <td class="confirm-table__text">{{ $genre->genre }}</td>
                    <input type="hidden" name="genre_id" value="{{ $shops['genre_id'] }}">
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">説明</th>
                    <td class="confirm-table__text">{{ $shops['description'] }}</td>
                    <input type="hidden" name="description" value="{{ $shops['description'] }}">
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">画像URL</th>
                    <td class="confirm-table__text">以下</td>
                    <input type="hidden" name="image" value="{{ $shops['image'] }}">
                </tr>
            </table>
        </div>
        <div class="img">
            <img src="{{ Storage::url('temp/' . $shops['image']) }}" alt="確認用画像" style="max-width: 300px;">
        </div>
        <div class="form__button">
            <input class="send__btn" type="submit" value="送信" name="send">
            <input class="back__btn" type="submit" value="修正" name="back">
        </div>
    </form>
</div>
@endsection