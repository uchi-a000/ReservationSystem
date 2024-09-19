@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">

@endsection

@section('content')
<div class="mypage-container">
    <h2 class="mypage__alert heading">{{ Auth::user()->name }} さんのページ</h2>
    <div class="mypage">
        <div class="mypage__inner">
            <form class="mypage-form" action="/mypage" method="GET">
                @csrf
            </form>
            <!-- 予約状況 -->
            <div class="information__block">
                <div class="information__inner">
                    <div class="reservation-done__content">
                        <div class="reservation-done__inner">
                            <h3 class="reservation__ttl">予約状況</h3>
                            @if($reservations->isEmpty())
                            <p class="reservation-done__not">予約情報はありません</p>
                            @else
                            @foreach($reservations as $index => $reservation)
                            <div class="reservation-done__table">
                                <table class="reservation-done__table-inner">
                                    <tr class="reservation-done__row">
                                        <td class="reservation-done__ttl">予約 {{ $index + 1 }}</td>
                                    </tr>
                                    <tr class="reservation-done__row">
                                        <th class="reservation-done__label">Shop</th>
                                        <td class="reservation-done__data">{{ $reservation->shop->shop_name }}</td>
                                    </tr>
                                    <tr class="reservation-done__row">
                                        <th class="reservation-done__label">Date</th>
                                        <td class="reservation-done__data">{{ $reservation->reservation_date }}</td>
                                    </tr>
                                    <tr class="reservation-done__row">
                                        <th class="reservation-done__label">Time</th>
                                        <td class="reservation-done__data">{{ substr( $reservation->reservation_time, 0, 5) }}</td>
                                    </tr>
                                    <tr class="reservation-done__row">
                                        <th class="reservation-done__label">Number</th>
                                        <td class="reservation-done__data">{{ $reservation->number_of_people }}人</td>
                                    </tr>
                                </table>

                                @if($now->lt($reservation->dayBefore))
                                <!-- 予約変更 -->
                                <div class="reservation-update">
                                    <form class="update" action="{{ route('reservation_update', $reservation->id) }}" method="GET">
                                        @csrf
                                        <button class="update-form__btn" type="submit">予約の変更</button>
                                    </form>
                                </div>

                                <!-- 削除 -->
                                <div class="reservation-delete">
                                    <a class="reservation-delete__btn" href="#delete-modal-{{ $reservation->id }}">削除</a>
                                    <div class="reservation-delete-modal">
                                        <div class="modal" id="delete-modal-{{ $reservation->id }}">
                                            <a href="#!" class="modal-overlay"></a>
                                            <div class="modal__inner">
                                                <div class="modal__content">
                                                    <form class="modal-reservation-delete-form" action="{{ route('reservation_delete', $reservation->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div class="modal-delete-form__item">
                                                            <p class="modal-delete__text">削除してよろしいですか？</p>
                                                            <table class="delete-info__table">
                                                                <tr class="delete-info__row">
                                                                    <th class="delete-info__label">Shop:</th>
                                                                    <td class="delete-info__data">{{ $reservation->shop->shop_name }}</td>
                                                                </tr>
                                                                <tr class="delete-info__row">
                                                                    <th class="delete-info__label">Date:</th>
                                                                    <td class="delete-info__data">{{ $reservation->reservation_date }}</td>
                                                                </tr>
                                                                <tr class="delete-info__row">
                                                                    <th class="delete-info__label">Time:</th>
                                                                    <td class="delete-info__data">{{ substr( $reservation->reservation_time, 0, 5) }}</td>
                                                                </tr>
                                                                <tr class="delete-info__row">
                                                                    <th class="delete-info__label">Number:</th>
                                                                    <td class="delete-info__data">{{ $reservation->number_of_people }}人</td>
                                                                </tr>
                                                            </table>
                                                            <button class="modal-delete__btn" type="submit">削除</button>
                                                            <a href="#" class="modal__close__btn">戻る</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif($reservation->paid == 1)
                                <p class="check_in-alert">ご来店済み</p>
                                <p class="paid-alert">お支払い完了</p>
                                @elseif($reservation->check_in == 1 )
                                <p class="check_in-alert">ご来店済み</p>
                                <a class="payment" href="/payment/{{ $reservation->id }}">お支払い</a>
                                @elseif($now->gt($reservation->dayBefore))
                                <p class="day-before__alert">変更・キャンセルは店舗へ直接ご連絡ください</p>
                                @endif

                                <!-- 当日QRコード発行〜評価機能 -->
                                @if($reservation->reviews->isNotEmpty())
                                <p class="review-done">口コミ投稿済み</p>
                                @elseif($reservation->check_in == 1 && $reservation->reviews->isEmpty())
                                <div class="review__content">
                                    <form class="review" action="{{ route('review', $reservation->id) }}" method="GET">
                                        @csrf
                                        <button class="review-form__btn" type="submit">口コミを投稿する</button>
                                    </form>
                                </div>
                                @elseif($now->gt($reservation->reservationDateTime))
                                <div class="qr-code">
                                    <form class="qr-code-form" action="{{ route('generate_qr_code', $reservation->id)  }}" method="POST">
                                        @csrf
                                        <button class="qr-code-form__btn" type="submit">QRコードを発行</button>
                                    </form>
                                </div>
                                @elseif($now->lt($reservation->reservationDateTime))
                                <p class="qr-code__alert">ご予約時間に来店確認のため<br>QRコードが発行されます</p>
                                @endif
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- お気に入り店舗 -->
                    <div class="favorites-shop__content">
                        <h3 class="favorite-shop__ttl">お気に入り店舗</h3>
                        <div class="favorites-shop__inner">
                            @if(isset($favorites) && $favorites->isNotEmpty())
                            @foreach($favorites as $favorite)
                            <div class="favorites-shop__block">
                                <div class="favorites-shop__img">
                                    @if(Storage::disk('public')->exists('images/' . $favorite->shop['image']))
                                    <img src="{{ Storage::url('images/' . $favorite->shop['image']) }}" alt="ストレージ画像">
                                    @else
                                    <img src="{{ $favorite->shop->image }}" alt="ダミー画像" />
                                    @endif
                                </div>
                                <div class="favorites-shop__card-content">
                                    <p class="favorites-shop__card-ttl">{{ $favorite->shop->shop_name }}</p>
                                    <p class="favorites-shop__tag">{{ $favorite->shop->area }} {{ $favorite->shop->genre }}</p>
                                    <div class="shop-detail__form">
                                        <div class="shop-detail__inner">
                                            <a class="shop-detail__form btn" href="{{ route('shop_detail', $favorite->shop->id) }}">詳しくみる</a>
                                            <form class="favorites__form" action="{{ route('favorites', $favorite->shop->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="favorites-submit" type="submit" name="favorites_destroy">
                                                    <img class="heart-img" src="{{ asset('icon/red_heart.svg')}}" alt="red_heart">
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <p class="favorites-shop__not">お気に入り店舗はありません</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection