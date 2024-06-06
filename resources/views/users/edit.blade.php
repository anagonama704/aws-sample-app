@extends('layouts.app')

@section('content')
<h1>会員情報編集</h1>
@include('commons.flash')
<form action="{{ route('users.update',$user->id) }}" method="post">
    @method('patch')
    @include('users.form')
    <button type="submit">更新</button>
</form>
@endsection
