@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review_update.css') }}">
@endsection

@section('content')
<div class="review__container">
    <div class="alert">
        @if(session('message'))
        <div class="alert--success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <div class="review-update__inner">
        <div>
            <div class="mein__ttl">
                <h2 class="ttl_1">口コミを編集する</h2>
            </div>
            <div class="shop__block">
                @if(isset($review))
                <div class="shop__img">
                    @if(Storage::disk('public')->exists('images/' . $review->shop['image']))
                    <img src="{{ Storage::url('images/' . $review->shop['image']) }}" alt="ストレージ画像">
                    @else
                    <img src="{{ $review->shop->image }}" alt="ダミー画像" />
                    @endif
                </div>
                <div class="shop-card__content">
                    <h2 class="shop-card__ttl">{{ $review->shop->shop_name }}</h2>
                    <p class="shop__tag">{{ $review->shop->area }} {{ $review->shop->genre }}</p>
                    <div class="shop-detail__form">
                        <div class="shop-detail__inner">
                            <a class="shop-detail__form_btn" href="{{ route('shop_detail', $review->shop->id) }}">詳しくみる</a>
                            @if(Auth::check() && $favorites->contains($review->shop->id))
                            <form class="favorites__form" action="{{ route('favorites', $review->shop->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="favorites-submit" type="submit" name="favorites_destroy">
                                    <img class="heart-img" src="{{ asset('icon/red_heart.svg')}}" alt="red_heart">
                                </button>
                            </form>
                            @else
                            <form class="favorites__form" action="{{ route('favorites', $review->shop->id) }}" method="POST">
                                @csrf
                                <button class="favorites-submit" type="submit" name="favorites_store">
                                    <img class="heart-img" src="{{ asset('icon/gray_heart.svg')}}" alt="gray_heart">
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="vertical-line"></div>
        <div class="review__block">
            <form class="review-form" action="{{ route('review_update', $review->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="shop_id" value="{{ $review->shop_id }}">

                <div class="ttl">
                    <h2 class="item__ttl">体験を評価してください</h2>
                </div>
                <div class="rating">
                    <input type="hidden" name="rating" id="rating" value="{{ old('rating', $review->rating) }}">
                    <span data-value="1" class="star {{ $review->rating >= 1 ? 'selected' : '' }}">★</span>
                    <span data-value="2" class="star {{ $review->rating >= 2 ? 'selected' : '' }}">★</span>
                    <span data-value="3" class="star {{ $review->rating >= 3 ? 'selected' : '' }}">★</span>
                    <span data-value="4" class="star {{ $review->rating >= 4 ? 'selected' : '' }}">★</span>
                    <span data-value="5" class="star {{ $review->rating == 5 ? 'selected' : '' }}">★</span>
                    <div class="form__error">
                        @error('rating')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="ttl">
                    <h2 class="item__ttl">口コミを投稿</h2>
                </div>
                <textarea class="review-form-item__textarea" name="comment" id="comment" oninput="updateCharCount()">{{ old('comment', $review->comment) }}</textarea>
                <div id="char-count" class="char-count">0/400文字</div>
                <div class="form__error">
                    @error('comment')
                    {{ $message }}
                    @enderror
                </div>

                <div class="img-upload__area">
                    <h2 class="item__ttl">画像を変更</h2>
                    @if ($review->images && is_array(json_decode($review->images, true)))
                    @foreach (json_decode($review->images, true) as $image)
                    <img id="img-preview" class="img-preview" src="{{ asset('storage/' . $image) }}" alt="口コミ画像" width="100">
                    @endforeach
                    @else
                    <img id="img-preview" class="mg-preview" src="" alt="口コミ画像" style="display: none;" width="100">
                    @endif
                    <div class="upload-area" id="upload-area">
                        <input id="file-upload" class="file" type="file" name="images[]" accept="image/*" style="display: none;" onchange="previewAndUploadImage(event)" />
                        <label for="file-upload" class="upload-btn">
                            クリックして写真を追加<p style="font-size: 12px;">またはドラッグアンドドロップ</p>
                        </label>
                    </div>
                    <div class="form__error">
                        @error('images.*')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <button class="review__btn" type="submit">口コミを更新</button>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('rating');
        const savedRating = ratingInput.value; // 保存されている評価を取得

        // 初期状態で保存されている評価に応じて星を表示
        if (savedRating) {
            stars.forEach(star => {
                const ratingValue = star.getAttribute('data-value');
                if (ratingValue <= savedRating) {
                    star.classList.add('active');
                }
            });
        }

        // 星をクリックしたときの動作
        stars.forEach(star => {
            star.addEventListener('click', () => {
                const ratingValue = star.getAttribute('data-value'); // クリックした星の値を取得
                ratingInput.value = ratingValue; // 隠しフィールドに値をセット

                // すべての星をリセット
                stars.forEach(s => s.classList.remove('active'));

                // 選択された星まで色を付ける
                star.classList.add('active');
                let previousSibling = star.previousElementSibling;
                while (previousSibling) {
                    previousSibling.classList.add('active');
                    previousSibling = previousSibling.previousElementSibling;
                }
            });
        });
    });


    //text文字count
    function updateCharCount() {
        const textarea = document.getElementById('comment');
        const charCountDisplay = document.getElementById('char-count');
        const currentLength = textarea.value.length;
        const maxLength = 400; // 最大文字数
        charCountDisplay.textContent = `${currentLength}/${maxLength}文字`;
    }
    // 初期表示用（ページロード時に既存の文字数を反映）
    document.addEventListener('DOMContentLoaded', updateCharCount);


    //画像プレビュー
    function previewAndUploadImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('img-preview');
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = "block";
            };
            reader.readAsDataURL(file);

            const formData = new FormData();
            formData.append('images', file);
        }
    }
</script>