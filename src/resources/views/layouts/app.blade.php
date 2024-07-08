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
        <div class="header-inner">
            <h1 class="header-ttl">Rese</h1>
            <div class="header-menu">
                <!-- 後でアイコン導入 モーダル画面作成-->
                @csrf
                @guest
                <nav class="header-nav">
                    <ul class="header-nav__list">
                        <li class="header-nav__item"><a href="/">Home</a></li>
                        <li class="header-nav__item"><a href="/register">Register</a></li>
                        <li class="header-nav__item"><a href="/login">Login</a></li>
                    </ul>
                </nav>
                @else
                <nav class="header-nav">
                    @if (Auth::check())
                    <ul class="header-nav__list">
                        <li class="header-nav__item"><a href="/">Home</a></li>
                        <form action="/logout" method="post" style="display: inline;">
                            @csrf
                            <button type="submit" class="header-nav__item-button">Logout</button>
                        </form>
                        <li class="header-nav__item"><a href="/mypage">Mypage</a></li>
                    </ul>
                    @endif
                </nav>
                @endguest
            </div>
        </div>
        <main>
            @yield('content')
        </main>

</body>

</html>