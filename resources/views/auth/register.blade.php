@extends('layouts.app')

@section('content')
<h1>会員登録</h1>
@include('commons.flash')
<form action="{{ route('register') }}" method="post">
    @csrf
    <p>
        <label>名前</label><br>
        <input type="text" name="name" value="{{ old('name') }}">
    </p>
    <p>
        <label>メールアドレス</label><br>
        <input type="email" name="email" value="{{ old('email') }}">
    </p>
    <p>
        <label>パスワード</label><br>
        <input type="password" name="password" value="">
    </p>
    <p>
        <label>パスワード確認</label><br>
        <input type="password" name="password_confirmation" value="">
    </p>
    <p>
        <label>生年月日</label><br>
        <input type="date" name="birth_date" value="{{ old('birth_date') }}">
    </p>
    <p>
        <label>郵便番号</label><br>
        <input type="text" name="zip_code" value="{{ old('zip_code') }}">
    </p>
    <p>
        <label>住所</label><br>
        <input type="text" name="address" value="{{ old('address') }}">
    </p>
    <p>
        <label>電話番号</label><br>
        <input type="text" name="tel" value="{{ old('tel') }}">
    </p>
    {{-- 管理者権限 --}}
    <input type="hidden" name="is_admin" value=0>
    <div>
        <a href="{{ route('login') }}">既にアカウント持ち？ログイン</a>
        <button type="submit">会員登録</button>
    </div>
</form>
@endsection
