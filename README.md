<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# 飲食店予約サービス
<!-- 従業員の勤怠打刻・管理（勤怠情報の確認） -->

<!-- <img width="1497" alt="スクリーンショット 2024-05-09 22 51 15" src="https://github.com/uchi-a000/Mockcase-first/assets/157282769/a7e5cd49-4ae5-4876-9f87-872ac5c156a6"> -->

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


## その他（機能詳細）
・【マイページ画面について】 前日以前：予約変更可能  
                        前日〜予約時間：「店舗へ直接連絡してください」のメッセージ  
                        予約時間：QRコード表示  
                        来店確認後：評価ができる  
・【予約変更機能】予約日時または予約人数をマイページから変更することができる（予約前日まで）  
・【評価機能】予約してお店に来店確認後に、利用者が店舗を5段階評価とコメントができるようにする  
・【ユーザー認証】メールによって本人確認を行うことができる  
・【QRコード】利用者が来店した際に店舗側に見せるQRコードを発行し、お店側は照合することができる  
・【メール送信】管理者からユーザーへお知らせメールを送信できる  
・【リマインダー】タスクスケジューラーを利用して、予約当日の朝に予約情報のリマインダーを送る
