@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_rep/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h2>ご登録内容確認</h2>
    </div>
    <form class="form" action="/shop/done" method="post" enctype="multipart/form-data">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">店舗名</th>
                    <td class="confirm-table__text">
                        <input type="text" name="shop_name" value="{{ $shop['shop_name'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">エリア</th>
                    <td class="confirm-table__text">
                        <input type="text" name="area" value="{{ $shop['area'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">ジャンル</th>
                    <td class="confirm-table__text">
                        <input type="text" name="genre" value="{{ $shop['genre'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">説明</th>
                    <td class="confirm-table__text">
                        <textarea name="description">{{ $shop['description'] }}</textarea>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">画像URL</th>
                    <td class="confirm-table__text">
                        <input type="text" name="image_url" value="{{ $shop['image_url'] }}">
                    </td>
                </tr>
            </table>
        </div>
        <div class="img">
            <img src="{{ Storage::url('temp/' . $shop['image_url']) }}" alt="確認用画像" style="max-width: 300px;">
        </div>
        <div class="form__button">
            <input class="send__btn" type="submit" value="送信" name="send">
            <input class="back__btn" type="submit" value="修正" name="back">
        </div>
    </form>
</div>
@endsection