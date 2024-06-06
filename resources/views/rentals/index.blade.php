@extends('layouts.app')
@section('content')
<h1>レンタル{{ Auth::user()->isAdmin() ? "一覧" : "履歴" }}</h1>
	<table border="1">
		<tr>
			<th></th>
			<th>ID</th>
			<th>書籍名</th>
			<th>レンタル日</th>
			<th>発送日</th>
			<th>返却日</th>
		</tr>
		@foreach    ($rentals as $rental)
			<tr>
				<td><a href="{{ route('rentals.show', $rental) }}">詳細</a></td>
				<td>{{ $rental->id }}</td>
				<td>{{ $rental->book->name }}</td>
				<td>{{ $rental->created_at->format('Y-m-d') }}</td>
                @if($rental->ship_date == null)
                    <td>未定</td>
                @else
				    <td>{{ $rental->ship_date->format('Y-m-d') }}</td>
                @endif
				<td>
                    <!-- 返却日があるなら、「返却日」の欄に返却日をフォーマットの形式で表示する -->
                        @if(!empty($rental->return_date))
						    {{ $rental->return_date->format('Y-m-d')}}
                    <!-- 返却日はないが、発送日がないまたは発送日が今日より先なら 、「返却日」の欄に「未発送」と表示する-->
                        @elseif(!$rental->ship_date || $rental->ship_date->format('Y-m-d') > Carbon\Carbon::now()->format('Y-m-d'))
                            未発送
                    <!-- 返却日がなく、かつ配達日が昨日以前、つまりまだ「返却日」の欄がnullなら -->
					    @else
                            <!-- 管理者じゃない=会員なら、「返却日」の欄に返却ボタンを表示する -->
                            @if(!Auth::user()->isAdmin())
                                <form action="{{ route('rentals.return', $rental->id) }}" method="post" id="{{ $rental->id }}">
                                    @csrf
                                    @method('patch')
                                    <button href="#" onclick="returnBook({{ $rental->id }})">返却</button>
                                </form>
                            @else
                            <!-- 会員でない、つまり管理者なら、「返却日」の欄に「未返却」と表示する -->
                                未返却
                            @endif
                        @endif
				</td>
			</tr>
		@endforeach
	</table>
	{{ $rentals->links() }}

	<script returnBook="text/javascript">
		function returnBook(id) {
			event.preventDefault();
			if(window.confirm('返却しますか?')) {
				document.getElementById(id).submit();
			}
		}
	</script>
@endsection
