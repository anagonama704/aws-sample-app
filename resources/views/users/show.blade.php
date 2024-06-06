@extends('layouts.app')

@section('content')
<h1>会員情報</h1>
<table>
    <tr><th>名前</th><td>{{ $user->name }}</td></tr>
    <tr><th>メールアドレス</th><td>{{ $user->email }}</td></tr>
    <tr><th>生年月日</th><td>{{ $user->birth_date }}</td></tr>
    <tr><th>郵便番号</th><td>{{  '〒'.preg_replace("/^.{0,3}+\K/us", '-', $user->zip_code)}}</td></tr>
    <tr><th>住所</th><td>{{ $user->address }}</td></tr>
    <tr><th>電話番号</th><td>{{ $user->tel }}</td></tr>
    {{-- <tr><th>管理者権限</th><td>{{ $user->is_admin == true ? 'あり' : 'なし' }}</td></tr> --}}
    {{-- <tr><th colspan="2"><a href="{{ route('rentals.index') }}">レンタル履歴</a></th></tr> --}}
</table>
<ul class="ul_edit">
    @if(Auth::user()->isAdmin())
    <li class="li_edit"><a href="#" onclick="deleteUser()">削除する</a></li>
    @else
    <li class="li_edit"><a href="{{ route('users.edit',$user->id) }}">編集する</a></li>
    <li class="li_edit"><a href="#" onclick="deleteUser()">退会する</a></li>
    @endif
    <form action="{{ route('users.destroy',$user) }}" method="post" id="delete-form">
        @csrf
        @method('delete')
    </form>
    {{-- 削除確認 --}}
    <script type="text/javascript">
        function deleteUser(){
            event.preventDefault();
            if (window.confirm('本当に退会しますか？')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</ul>
@endsection
