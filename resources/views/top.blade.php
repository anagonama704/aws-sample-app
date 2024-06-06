@extends('layouts.app')
@section('content')
<div class="container">
    <div style="display: flex;">
    	<div>
    		<h1 style="font-family: 'M PLUS Rounded 1c', sans-serif;">ようこそ</h1><br>
    		<div style="display: flex; justify-content: flex-end;"><h1 style="font-family: 'M PLUS Rounded 1c', sans-serif;"><strong>リスキルブック</strong>へ</h1></div>
            <div style="display: flex; justify-content: flex-end;"><h1 style="font-family: 'M PLUS Rounded 1c', sans-serif;"><i class="emoji">🎉</i></h1></div>
    	</div>
    	<div>
    		<img src="{{ asset('image/top.png')}}" class="customize_img">
    	</div>
    </div><br>
    <div style="text-align: center; display: flex">
    	@if (Auth::check())
    		<button onclick="location.href='{{ route('books.index') }}'" class="customize_btn">Enter</button>
    	@else
    		<button onclick="location.href='{{ route('login') }}'" class="customize_btn">Enter</button>
    	@endif
    </div>
</div>
@endsection
