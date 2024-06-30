<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# 飲食店予約サービス
<!-- 従業員の勤怠打刻・管理（勤怠情報の確認） -->

<!-- <img width="1497" alt="スクリーンショット 2024-05-09 22 51 15" src="https://github.com/uchi-a000/Mockcase-first/assets/157282769/a7e5cd49-4ae5-4876-9f87-872ac5c156a6"> -->

## 作成した目的
php・laravelを学習中で練習のために作成しました。

## 機能一覧
  <!-- ユーザー会員登録/ログイン  
  勤怠管理機能（出勤開始/終了・休憩開始/終了）  
  日付別勤怠ページ  
  ユーザー一覧ページ  
  ユーザー毎の勤務表ページ -->

## 使用技術（実行環境）
・PHP 8.0
・laravel 10.0
・MySQL  8.0

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

## その他（機能詳細）
<!-- ○勤怠ボタン(打刻後は次に必要なボタン以外は非表示にしています（誤打刻防止）)  
  勤務開始→勤務終了と休憩開始打刻のみ表示  
  休憩開始→休憩終了打刻のみ表示  
  休憩終了→休憩開始と勤務終了打刻の表示  
  勤務終了→勤務開始打刻のみ表示 -->

<!-- ○その他  
  日を跨ぐと翌日の出勤に切り替わる（休憩含む）  
  休憩は何度でも取得可能  
  日付一覧ページ：年月日検索可能  
  ユーザー一覧ページ：名前、メールアドレスで曖昧検索可能  
  ユーザー毎の勤務表ページ：月検索可能 -->

