@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h2>メール内容</h2>
        <h3>下記内容で送信してよろしいですか</h3>
    </div>
    <form class="form" action="/admin/notify" method="post">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">件名</th>
                    <td class="confirm-table__text">
                        <input type="text" name="subject" value="{{ $notify['subject'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">本文</th>
                    <td class="confirm-table__text">
                        <textarea type="text" name="message" readonly>{{ $notify['message'] }}</textarea>
                    </td>
                </tr>
            </table>
        </div>
        <div class="form__button">
            <input class="send__btn" type="submit" value="送信" name="send">
            <input class="back__btn" type="submit" value="修正" name="back">
        </div>
    </form>
</div>

@endsection