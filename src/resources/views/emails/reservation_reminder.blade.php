<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <h1>{{ $reservation->user->name }} 様</h1>

    <p>この度はご予約をいただき、誠にありがとうございます。</p>
    <p>本日ご来店日となりましたのでご連絡します。</p>

    <p><strong>予約情報</strong></p>
    <ul>
        <li><strong>店舗名：</strong>{{ $shopName }}</li>
        <li><strong>予約日：</strong>{{ $reservation->reservation_date}}</li>
        <li><strong>予約時間：</strong>{{ $reservation->reservation_time, 0, 5 }}</li>
        <li><strong>人数：</strong>{{ $reservation->number_of_people }} 名</li>
    </ul>

    <p>ご来店を心よりお待ちしております。</p>
</body>

</html>