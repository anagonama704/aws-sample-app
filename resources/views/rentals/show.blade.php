@extends('layouts.app')
@section('content')
<h1>レンタル詳細</h1>
<table>
    <tr>
        <th>氏名</th>
        <td>{{ $rental->user->name }}</td>
    </tr>
    <tr>
        <th>書籍名</th>
        <td>{{ $rental->book->name }}</td>
    </tr>
    <tr>
        <th>レンタル日</th>
        <td>{{ $rental->created_at->format('Y-m-d') }}</td>
    </tr>
    <tr>
        <th>発送日</th>
        <td>{{ $rental->ship_date ? $rental->ship_date->format('Y-m-d'):'未定' }}</td>
    </tr>
    <tr>
        <th>返却日</th>
                <td>
                    <!-- 返却日があるなら、「返却日」の欄に返却日をフォーマットの形式で表示する -->
                        @if(!empty($rental->return_date))
                            {{ $rental->return_date->format('Y-m-d')}}
                    <!-- 返却日はないが、発送日がないまたは発送日が今日より先なら 、「返却日」の欄に「未発送」と表示する-->
                        @elseif(!$rental->ship_date || $rental->ship_date->format('Y-m-d') > Carbon\Carbon::now()->format('Y-m-d'))
                            未発送
                    <!-- 返却日がなく、かつ配達日が昨日以前、つまりまだ「返却日」の欄がnullなら -->
                        @else
                            未返却
                        @endif
                </td>
    </tr>
</table>
@if (Auth::user()->isAdmin())
    <button onclick="location.href='{{ route('rentals.edit', $rental) }}'">編集</button>
    <button href="#" onclick="deleteRental()">削除</button>
    <form action="{{ route('rentals.destroy', $rental) }}" method="post" id="delete-rental">
        @csrf
        @method('delete')
    </form>
@endif
<script type="text/javascript">
    function deleteRental() {
        event.preventDefault();
        if(window.confirm('本当に削除しますか?')) {
            document.getElementById('delete-rental').submit();
        }
    }
</script>
@endsection
