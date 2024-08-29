@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_rep/reservations.css') }}">
@endsection

@section('content')
<div class="shop-rep-reservations__container">
    <div class="shop-rep-reservations__heading">
        <a class="info-link" href="/shop/info">&lt;</a>
        <h2 class="alert">{{ $shop->shop_name }}の予約情報</h2>
    </div>
    @if(!$reservations)
    <p>予約情報はありません</p>
    @else
    @foreach($reservations as $index => $reservation)
    <div class="reservations__table">
        <table class="reservations__table-inner">
            <tr class="reservations__row">
                <td class="reservations__ttl">予約 {{ $index + 1 }}</td>
            </tr>
            <tr class="reservations__row">
                <th class="reservations__header">username</th>
                <td class="reservations__data">{{ $reservation->user->name }}</td>
            </tr>
            <tr class="reservations__row">
                <th class="reservations__header">email</th>
                <td class="reservations__data">{{ $reservation->user->email }}</td>
            </tr>
            <tr class="reservations__row">
                <th class="reservations__header">Date</th>
                <td class="reservations__data">{{ $reservation->reservation_date }}</td>
            </tr>
            <tr class="reservations__row">
                <th class="reservations__header">Time</th>
                <td class="reservations__data">{{ substr( $reservation->reservation_time, 0, 5) }}</td>
            </tr>
            <tr class="reservations__row">
                <th class="reservations__header">Number</th>
                <td class="reservations__data">{{ $reservation->number_of_people }}人</td>
            </tr>
        </table>
    </div>
    @endforeach
    @endif
</div>
@endsection