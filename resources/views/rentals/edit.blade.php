@extends('layouts.app')
@section('content')
<h1>レンタル編集</h1>
<form action="{{ route('rentals.update', $rental) }}" method="post">
	@csrf
	@method('patch')
	<dl>
		<dt>発送日</dt>
		<dd><input type="date" name="ship_date" value="{{ old( 'ship_date', $rental->ship_date) }}"></dd>
	</dl>
	<button type="submit">更新</button>
	<a href="{{ route('rentals.show', $rental) }}">キャンセル</a>
</form>
@endsection
