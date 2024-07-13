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