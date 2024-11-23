@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<div class="review__container">
    <div class="review__inner">
        <div>
            <div class="mein__ttl">
                <a class="shop_detail__home-link" href="{{ route('shop_detail', $reservation->shop_id) }}">&lt;</a>
                <h2 class="ttl_1">今回のご利用はいかがしたか？</h2>
            </div>
            <div class="shop__block">
                @if(isset($reservation))
                <div class="shop__img">
                    @if(Storage::disk('public')->exists('images/' . $reservation->shop['image']))
                    <img src="{{ Storage::url('images/' . $reservation->shop['image']) }}" alt="ストレージ画像">
                    @else
                    <img src="{{ $reservation->shop->image }}" alt="ダミー画像" />
                    @endif
                </div>
                <div class="shop-card__content">
                    <h2 class="shop-card__ttl">{{ $reservation->shop->shop_name }}</h2>
                    <p class="shop__tag">#{{ $reservation->shop->area->area }} #{{ $reservation->shop->genre->genre }}</p>
                    <div class="shop-detail__form">
                        <div class="shop-detail__inner">
                            <a class="shop-detail__form_btn" href="{{ route('shop_detail', $reservation->shop->id) }}">詳しくみる</a>
                            @if(Auth::check() && $favorites->contains($reservation->shop->id))
                            <form class="favorites__form" action="{{ route('favorites', $reservation->shop->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="favorites-submit" type="submit" name="favorites_destroy">
                                    <img class="heart-img" src="{{ asset('icon/red_heart.svg')}}" alt="red_heart">
                                </button>
                            </form>
                            @else
                            <form class="favorites__form" action="{{ route('favorites', $reservation->shop->id) }}" method="POST">
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
            <form class="review-form" action="/review_thanks" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="shop_id" value="{{ $reservation->shop_id }}">
                <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                <div class="ttl">
                    <h2 class="item__ttl">体験を評価してください</h2>
                </div>
                <div class="rating">
                    <input type="hidden" name="rating" id="rating" value="{{ old('rating', '') }}">
                    <span data-value="1" class="star">★</span>
                    <span data-value="2" class="star">★</span>
                    <span data-value="3" class="star">★</span>
                    <span data-value="4" class="star">★</span>
                    <span data-value="5" class="star">★</span>
                </div>
                <div class="form__error">
                    @error('rating')
                    {{ $message }}
                    @enderror
                </div>
                <div class="ttl">
                    <h2 class="item__ttl">口コミを投稿</h2>
                </div>
                <textarea class="review-form-item__textarea" name="comment" id="comment" oninput="updateCharCount()">{{ old('comment') }}</textarea>
                <div id="char-count" class="char-count">0/400文字</div>
                <div class="form__error">
                    @error('comment')
                    {{ $message }}
                    @enderror
                </div>
                <div class="img-upload__area">
                    <h2 class="item__ttl">画像を追加</h2>
                    <div class="upload-area" id="upload-area">
                        <input id="file-upload" class="file" type="file" name="images[]" accept="image/*" style="display: none;" multiple onchange="previewAndUploadImage(event)" />
                        <label for="file-upload" class="upload-btn">
                            クリックして写真を追加
                            <p style="font-size: 12px;">またはドラッグアンドドロップ</p>
                        </label>
                    </div>
                    <div id="preview-images"></div>
                    <div class="form__error">
                        @error('images.*')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <button class="review__btn" type="submit">口コミを投稿</button>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    // star
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('rating');

        // ページが再表示されても値を保持
        const initialRating = ratingInput.value;
        if (initialRating) {
            stars.forEach(star => {
                if (star.getAttribute('data-value') <= initialRating) {
                    star.classList.add('active');
                }
            });
        }

        stars.forEach(star => {
            // 星をクリックしたときの動作
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
        const files = event.target.files;
        const previewContainer = document.getElementById('preview-images');

        // 複数画像プレビューの処理
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
                const previewWrapper = document.createElement('div');
                previewWrapper.style.display = 'inline-block';
                previewWrapper.style.position = 'relative';
                previewWrapper.style.margin = '10px';

                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.style.width = '100px';
                imgElement.style.height = '100px';
                imgElement.style.objectFit = 'cover';

                const deleteBtn = document.createElement('button');
                deleteBtn.textContent = '×';
                deleteBtn.style.position = 'absolute';
                deleteBtn.style.top = '0';
                deleteBtn.style.right = '0';
                deleteBtn.style.backgroundColor = 'red';
                deleteBtn.style.color = 'white';
                deleteBtn.style.border = 'none';
                deleteBtn.style.cursor = 'pointer';
                deleteBtn.style.borderRadius = '50%';
                deleteBtn.style.width = '20px';
                deleteBtn.style.height = '20px';
                deleteBtn.style.fontSize = '12px';

                deleteBtn.addEventListener('click', function() {
                    previewWrapper.remove();
                });

                previewWrapper.appendChild(imgElement);
                previewWrapper.appendChild(deleteBtn);
                previewContainer.appendChild(previewWrapper);
            };
            reader.readAsDataURL(file); // 画像をデータURLとして読み込む
        }
    }
</script>