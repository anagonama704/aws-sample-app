@extends('layouts.app')

@section('content')
<h1>会員一覧</h1>
<table class="table">
    <thead>
        <tr>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>生年月日</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td><a href="{{ route('users.show',$user->id) }}">{{ $user->name }}</a></td>
                <td>
                    {{ $user->email }}
                </td>
                <td>{{ $user->birth_date }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}
@endsection
