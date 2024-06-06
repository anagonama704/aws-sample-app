@csrf
<p>
    <label>名前</label><br>
    <input type="text" name="name" value="{{ $user->name }}">
</p>
{{-- <p>
    <label>メールアドレス</label><br>
    <input type="email" name="email" value="{{ $user->email }}">
</p>
<p>
    <label>パスワード</label><br>
    <input type="password" name="password" value="">
</p>
<p>
    <label>パスワード確認</label><br>
    <input type="password" name="password_confirmation" value="">
</p> --}}
<p>
    <label>生年月日</label><br>
    <input type="date" name="birth_date" value="{{ $user->birth_date }}">
</p>
<p>
    <label>郵便番号</label><br>
    <input type="text" name="zip_code" value="{{ $user->zip_code }}">
</p>
<p>
    <label>住所</label><br>
    <input type="text" name="address" value="{{ $user->address }}">
</p>
<p>
    <label>電話番号</label><br>
    <input type="text" name="tel" value="{{ $user->tel }}">
</p>
