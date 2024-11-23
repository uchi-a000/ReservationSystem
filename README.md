<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# 飲食店予約サイト

飲食店の予約や削除、お気に入り追加やお店の詳細も確認できます。（管理画面あり）

<img width="1420" alt="スクリーンショット 2024-11-21 22 30 34" src="https://github.com/user-attachments/assets/36e79c3c-6b97-4272-84aa-9928b7b2d1fa">

## 作成した目的

php・laravel を学習中で練習のために作成しました。

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
ランダム・評価高い順・評価が低い順で検索する  
口コミ投稿機能

## 使用技術（実行環境）

・PHP 8.0
・laravel 10.0
・MySQL 8.0
・Fortify
・Mailhog(テストメール)

## テーブル設計

<img width="660" alt="スクリーンショット 2024-11-23 10 21 25" src="https://github.com/user-attachments/assets/9a3d20d9-9f9d-47b8-bf41-15641faab697">
<img width="659" alt="image" src="https://github.com/user-attachments/assets/3d1dd96d-4975-4400-bd67-7d93e8b3e076">
<img width="657" alt="スクリーンショット 2024-09-21 15 17 05" src="https://github.com/user-attachments/assets/b8f0372a-9a1c-485b-a374-c530ef767b17">
<img width="657" alt="スクリーンショット 2024-09-20 18 06 22" src="https://github.com/user-attachments/assets/5cfa8c28-17a1-4c38-b931-fca4fca9abaf">

## ER 図

<img width="980" alt="image" src="https://github.com/user-attachments/assets/4f98f286-b6f3-4fb1-becd-1e6df89433a3">

## 環境構築

1.  docker-compose up -d --build （docker-compose ビルド&起動）
2.  docker-compose exe php bash （PHP コンテナ内にログイン）
3.  composer install （パッケージインストール）
4.  cp .env.example .env （.env ファイルの作成(ファイルから.env を作成し、環境変数を変更)）
5.  php artisan key:generate (アプリケーションを実行)
6.  php artisan migrate（マイグレーション）
7.  php artisan db:seed（シーディング）
8.  メール認証  
    .env ファイルと docker-compose.yml にテストメール（Mailtrap）内容記述
9.  QR コード作成  
    composer require simplesoftwareio/simple-qrcode（インストール）
10. 管理画面  
    composer require spatie/laravel-permission（Spatie Laravel Permission パッケージインストール）  
    php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"（設定ファイルを生成）  
    php artisan migrate
11. 画像ストレージ保存  
    php artisan storage:link（ストレージに保存した画像を表示）
12. stripe 決済  
    composer require stripe/stripe-php （Stripe パッケージのインストール）
13. csv インポート（管理者のみ）  
    composer require maatwebsite/excel:^3.1.48 -W (Laravel Excel パッケージのインストール)  
    php artisan make:import ShopsImport --model=Store (インポート用クラスの作成)

    Google スプレッドシートに入力し、ファイル → ダウンロード → カンマ区切り形式（csv）で保存  
    （csv ファイルの記述方法）(補足※A1 列から記述していただかないとエラーになります)  
<img width="952" alt="image" src="https://github.com/user-attachments/assets/d27cb71a-bb46-4ef9-a7f7-5fab58a4b6aa">

## 管理者情報

メールアドレス：admin@example.com  
パスワード：pppp0000

## その他機能（詳細）

・【マイページ画面について（利用者向け）】  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;前日以前：予約変更とキャンセル（削除）が可能  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;前日〜予約時間：「店舗へ直接連絡してください」のメッセージ(変更・削除不可)  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;予約時間：QR コード表示  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;来店確認後：評価ができる + Stripe で支払いができる  
・【予約変更機能】予約日時または予約人数をマイページから変更できキャンセル（削除）もできる（予約前日まで）  
・【レスポンシブデザイン】タブレット・スマートフォン用のレスポンシブデザインを作成  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ブレイクポイントは 768px  
・【管理画面】管理者と店舗代表者と利用者の 3 つの権限を作成（左上モーダルメニューで各権限のメニューを表示）  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;店舗代表者が店舗情報の作成、更新と予約情報の確認ができる管理画面を作成（予約情報の確認は登録後にできる）  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;管理者側は店舗代表者を作成、店舗代表者一覧を確認でき、お知らせメールを送れる管理画面を作成  
・【ストレージ】お店の画像をストレージに保存することができる  
・【認証】メールによって本人確認を行うことができる（管理者・店舗代表者除く）  
・【メール送信】管理者からユーザーへお知らせメールを送信できる  
・【リマインダー】タスクスケジューラーを利用して、予約当日の朝に予約情報のリマインダーを送る（開発環境"php artisan send:reservation-reminders"で実行）  
・【QR コード】利用者が来店した際に店舗側に見せる QR コードを発行し、お店側は照合することができる  
・【決済機能】Stripe を利用して決済をすることができる  
・【口コミ投稿機能】予約して来店確認後に、利用者が店舗に対し評価（星５段階）・コメント・画像追加ができる  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;利用者は自分の口コミのみ編集と削除ができる  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;管理者は全ての口コミを削除することができる（[全ての口コミ情報]から）

## URL

・開発環境：http://localhost/  
・phpMyAdmin:：http://localhost:8080/
