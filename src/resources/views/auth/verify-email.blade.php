<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
</head>

<body>
    <div class="content__head">
        <div class="content__head--inner">
            <h2 class="email__form">メールアドレスの確認</h2>
            <p class="email__form--content">
                ご登録アドレスにメールを送信しました<br />
                利用を開始する前に、メール認証をしてください<br />
                もしメールが届かない場合は、再送信をしてください
            </p>
            @if (session('status'))
            <div class="alert">{{ session('status') }}</div>
            @endif
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button class="email--form__submit" type="submit">確認メールを再送信</button>
            </form>
        </div>
    </div>
</body>
</html>