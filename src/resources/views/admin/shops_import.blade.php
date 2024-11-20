@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/shops_import.css') }}">
@endsection

@section('content')
<div class="admin__container">
    @if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="/admin/shops/import" method="POST" enctype="multipart/form-data">
        @csrf
        <input class="file" type="file" name="csv_file" required>
        <button class="submit" type="submit">インポート</button>
    </form>
</div>
@endsection