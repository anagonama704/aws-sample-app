@extends('layouts.app')

@section('content')
<h1>ログイン</h1>
@include('commons.flash')
<form action="{{ route('login') }}" method="post">
	@csrf
	<dl>
		<dt>メールアドレス</dt>
		<dd><input type="email" name="email" value="{{ old('email') }}"></dd>

		<dt>パスワード</dt>
		<dd><input type="password" name="password" value=""></dd>
	</dl>
		<button type="submit">ログイン</button>

</form>
@endsection
