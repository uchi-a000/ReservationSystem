<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# 飲食店予約サービス
飲食店の予約、管理（管理画面有り）

<img width="1350" alt="スクリーンショット 2024-09-11 22 34 01" src="https://github.com/user-attachments/assets/807dfb20-df72-44bb-bc5c-bcf7e103936e">

## 作成した目的
php・laravelを学習中で練習のために作成しました。

## 機能一覧
ユーザ会員登録 ログイン ログアウト  
ユーザー情報取得  
ユーザー飲食店お気に入り一覧取得  
ユーザー飲食店予約情報取得  
飲食店一覧取得  
飲食店詳細取得  
飲食店お気に入り追加  
飲食店お気に入り削除  
飲食店予約情報追加  
飲食店予約情報削除  
エリアで検索する  
ジャンルで検索する  
店名で検索する  

## 使用技術（実行環境）
・PHP 8.0
・laravel 10.0
・MySQL  8.0
・Fortify
・Mailhog(テストメール)



## テーブル設計
<img width="659" alt="スクリーンショット 2024-09-20 18 07 40" src="https://github.com/user-attachments/assets/e8ee37ef-533d-4aca-a238-62ce0af7c75f">
<img width="657" alt="スクリーンショット 2024-09-20 18 06 22" src="https://github.com/user-attachments/assets/5cfa8c28-17a1-4c38-b931-fca4fca9abaf">

## ER 図


## 環境構築
1.  docker-compose up -d --build （docker-composeビルド&起動）
2.  docker-compose exe php bash （PHPコンテナ内にログイン）
3.  composer install （パッケージインストール）
4.  cp .env.example .env （.envファイルの作成(ファイルから.env を作成し、環境変数を変更)）
5.  php artisan key:generate (アプリケーションを実行)
6.  php artisan migrate（マイグレーション）
7.  php artisan db:seed（シーディング）
8. QRコード作成  
   composer require simplesoftwareio/simple-qrcode（インストール）  
9. 管理画面  
    composer require spatie/laravel-permission（Spatie Laravel Permissionパッケージインストール）  
    php artisan db:seed（シーディング）  
10. 画像ストレージ保存  
    php artisan storage:link（ストレージに保存した画像を表示）
11. stripe決済  
    composer require stripe/stripe-php （Stripeパッケージのインストール）

## 管理者情報
メールアドレス：admin@example.com  
パスワード：pppp0000

## その他機能（詳細）
・【マイページ画面について（利用者向け）】  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;前日以前：予約変更と削除が可能  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;前日〜予約時間：「店舗へ直接連絡してください」のメッセージ  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;予約時間：QRコード表示  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;来店確認後：評価ができる + Stripeで支払いができる  
・【予約変更機能】予約日時または予約人数をマイページから変更でき削除もできる（予約前日まで）  
・【評価機能】予約して来店確認後に、利用者が店舗を5段階評価とコメントができる  
・【レスポンシブデザイン】タブレット・スマートフォン用のレスポンシブデザインを作成  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ブレイクポイントは768px  
・【管理画面】管理者と店舗代表者と利用者の3つの権限を作成  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;店舗代表者が店舗情報の作成、更新と予約情報の確認ができる管理画面を作成（予約情報の確認は登録後にできる）  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;管理者側は店舗代表者を作成、店舗代表者一覧を確認でき、お知らせメールを送れる管理画面を作成  
・【ストレージ】お店の画像をストレージに保存することができる  
・【認証】メールによって本人確認を行うことができる（管理者・店舗代表者除く）  
・【メール送信】管理者からユーザーへお知らせメールを送信できる  
・【リマインダー】タスクスケジューラーを利用して、予約当日の朝に予約情報のリマインダーを送る（開発環境"php artisan send:reservation-reminders"で実行）  
・【QRコード】利用者が来店した際に店舗側に見せるQRコードを発行し、お店側は照合することができる  
・【決済機能】Stripeを利用して決済をすることができる  

## URL
・開発環境：http://localhost/  
・phpMyAdmin:：http://localhost:8080/

