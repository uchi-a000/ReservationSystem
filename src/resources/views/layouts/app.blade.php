<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/748afbedc1.js" crossorigin="anonymous"></script>
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-menu-icon">
                <a class="menu__link" href="#menu-modal">
                    <i class="line-1"></i>
                    <i class="line-2"></i>
                    <i class="line-3"></i>
                </a>
            </div>
            <h1 class="header__ttl">Rese</h1>
            @if(Request::is('/') || Request::is('home') || Request::is('search'))
            <div class="search__content">
                <div class="search__inner">
                    <form class="search-form" action="/search" method="get">
                        @csrf
                        <div class="search-form__area">
                            <select class="search-form__area-select" name="area">
                                <option disabled selected>All area</option>
                                <option value="東京都" @if( request('area')=='東京都' ) selected @endif>東京都</option>
                                <option value="大阪府" @if( request('area')=='大阪府' ) selected @endif>大阪府</option>
                                <option value="福岡県" @if( request('area')=='福岡県' ) selected @endif>福岡県</option>
                            </select>
                        </div>
                        <div class="search-form__genre">
                            <select class="search-form__genre-select" name="genre">
                                <option disabled selected>All genre</option>
                                <option value="焼肉" @if( request('genre')=='焼肉' ) selected @endif>焼肉</option>
                                <option value="居酒屋" @if( request('genre')=='居酒屋' ) selected @endif>居酒屋</option>
                                <option value="寿司" @if( request('genre')=='寿司' ) selected @endif>寿司</option>
                                <option value="ラーメン" @if( request('genre')=='ラーメン' ) selected @endif>ラーメン</option>
                                <option value="イタリアン" @if( request('genre')=='イタリアン' ) selected @endif>イタリアン</option>
                            </select>
                        </div>
                        <input class="search-form__keyword-input" type="text" name="keyword" placeholder="Search..." value="{{request('keyword')}}">
                        <div class="search-form__button">
                            <button class="search-form__button-submit" type="submit">検索</button>
                            <button class="search-form__button-submit__reset" type="submit" name="reset">リセット</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif

        </div>
        <div class="header-menu">
            <div class="modal" id="menu-modal">
                <a href="#!" class="modal-overlay"></a>
                <div class="modal__inner">
                    <div class="modal__content">
                        @guest
                        <nav class="modal-form__group-nav">
                            <ul class="modal-form__list">
                                <li class="modal-form__list-item"><a href="/">Home</a></li>
                                <li class="modal-form__list-item"><a href="/register">Register</a></li>
                                <li class="modal-form__list-item"><a href="/login">Login</a></li>
                            </ul>
                        </nav>
                        <a href="#" class="modal__close-btn">×</a>
                        @else
                        <nav class="modal-form__group-nav">
                            @if (Auth::check())
                            <ul class="modal-form__list">
                                <li class="modal-form__list-item"><a href="/">Home</a></li>
                                <form action="/logout" method="post" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="modal-form__list-item__button">Logout</button>
                                </form>
                                <li class="modal-form__list-item"><a href="/mypage">Mypage</a></li>
                            </ul>
                            @endif
                        </nav>
                        <a href="#" class="modal__close-btn">×</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
        <main>
            @yield('content')
        </main>
</body>

</html>