@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<div class="review">
    <div class="review__inner">
        <form class="review-form" action="/review_thanks" method="POST">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">
            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
            <div class="review__heading">
                <a class="link" href="/mypage">&lt;</a>
                <h2 class="ttl">ご来店ありがとうございました<br>お店はいかがでしたか？</h2>
            </div>
            <div class="review-form-item">
                <p class="review-form-item__label">
                    <span class="review-form-item__label-required">必須</span>5.とても満足 4.満足 3.ふつう 2.不満 1.とても不満
                </p>
                <select class="review-form-item__select" name="rating" id="rating">
                    <option value="">選択してください</option>
                    <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>5</option>
                    <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4</option>
                    <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3</option>
                    <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2</option>
                    <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1</option>
                </select>
                <div class="form__error">
                    @error('rating')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="review-form__item">
                <p class="review-form-item__label">
                    <span class="review-form-item__label-required">必須</span>コメント
                </p>
                <textarea class="review-form-item__textarea" name="comment" id="comment">{{ old('comment') }}</textarea>
                <div class="form__error">
                    @error('comment')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <a class="review-modal__link" href="#review-modal-{{ $reservation->id }}">投稿</a>
            <div class="review-modal" id="review-modal-{{ $reservation->id }}">
                <a href="#!" class="review-modal-overlay"></a>
                <div class="review-modal__inner">
                    <div class="review-modal__content">
                        <h3>投稿してよろしいですか？</h3>
                        <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                        <input type="hidden" name="user_id" value="{{ $reservation->user_id }}">
                        <input type="hidden" name="shop_id" value="{{ $reservation->shop->id }}">
                        <button class="review-modal__btn" type="submit">投稿</button>
                        <a href="#" class="review-modal__close__btn">修正</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection