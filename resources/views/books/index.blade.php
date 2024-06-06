@extends('layouts.app')

@section('content')
    <a href="#" id="return_to_top" class="page_top_btn">Top</a>
    <h1>書籍一覧</h1>
    @if (Auth::check() && Auth::user()->is_admin)
        <div>
            <p><a href="{{ route('books.create') }}">+新規作成</a></p>
        </div>
    @endif
    {{-- 検索フォーム --}}
    <form action="{{ route('books.index') }}" method="get" class="search_area">
        <dd>
            <label for="book_name_keyword">キーワード</label>
            <input type="text" name="book_name_keyword" value="{{ request('book_name_keyword') }}" placeholder="書籍名"
                id="book_name_keyword">
        </dd>
        <table class="detailed_search" tabindex="0">
            <thead class="drop_action" tabindex="0">
                <tr>
                    <th colspan="4">詳細検索</th>
                </tr>
            </thead>
            <tbody class="drop_menu" tabindex="1">
                <tr>
                    <th>著者</th>
                    <td>
                        <input type="text" name="author_name_keyword" value="{{ request('author_name_keyword') }}"
                            placeholder="著者名" id="author_name_keyword">
                    </td>
                    <th>出版社</th>
                    <td>
                        <input type="text" name="publisher_name_keyword" value="{{ request('publisher_name_keyword') }}"
                            placeholder="出版社名" id="publisher_name_keyword">
                    </td>
                </tr>
                <tr>
                    <th>カテゴリ</th>
                    <td>
                        <select name="category_id" id="category_id">
                            <option value="">未選択</option>
                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"{{ request('category_id') == $category->id ? ' selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <th>貸出可否</th>
                    <td>
                        <input type="radio" name="is_rentable" value="enable" id="is_rentable_1"
                            @if (request('is_rentable') == 'enable') checked @endif>
                        <label for="is_rentable_1">可</label>
                        <input type="radio" name="is_rentable" value="disable" id="is_rentable_0"
                            @if (request('is_rentable') == 'disable') checked @endif>
                        <label for="is_rentable_0">不可</label>
                        <input type="radio" name="is_rentable" value="" id="is_rentable_null"
                            @if (request('is_rentable') == '') checked @endif>
                        <label for="is_rentable_null">指定なし</label>
                    </td>
                </tr>
                <tr>
                    <th>ソート</th>
                    <td colspan="3">
                        <select name="sort" id="sort">
                            <option>新着順</option>
                            <option value="liked_desc" {{ request('sort') == 'liked_desc' ? ' selected' : '' }}>人気順</option>
                            <option value="rented_desc" {{ request('sort') == 'rented_desc' ? ' selected' : '' }}>貸出数順
                            </option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>

        <button type="submit">検索</button>
    </form>
    <br>
    <table border="1">
        <tr>
            {{-- <th>詳細</th> --}}
            <th>ID</th>
            <th>表紙</th>
            <th>書籍名</th>
            <th>著者</th>
            <th>出版社</th>
            <th>カテゴリ</th>
            <th>貸出状況</th>
            <th>発売日</th>
            <th>人気</th>
            @if (Auth::user()->isAdmin())
                {{-- 管理者にカートボタンを表示させない --}}
            @else
                <th>追加</th>
            @endif
        </tr>
        @foreach ($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>
                    @if (empty($book->image))
                        <img style="display: block; margin: auto;" src="{{ asset('image\sample_book.png') }}">
                    @else
                        <img style="display: block; margin: auto;" src=" {{ asset('storage/' . $book->image) }}">
                    @endif
                </td>
                {{-- <td><p>{{ $book->name }}</p></td> --}}
                <td><a href="{{ route('books.show', $book->id) }}">{{ $book->name }}</a></td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->publisher }}</td>
                <td>{{ $book->category->name }}</td>
                @if (Auth::user()->isAdmin())
                    <td>{{ $book->isRentable($book->id) ? '貸出可能' : '貸出不可' }}</td>
                @else
                    <td>{{ $book->isRentable($book->id) ? '〇' : '✖' }}</td>
                @endif
                <td>{{ $book->created_at->format('Y/m/d') }}</td>
                {{-- お気に入りボタン --}}
                <td>
                    <div style="display: flex; align-items:center;">
                        <p style="margin: 0 5px">{{ $book->likes_count }} </p>
                        @if (Auth::user()->isAdmin())
                            {{-- 管理者にお気に入りボタンを表示させない --}}
                        @else
                            @if (Auth::user()->isLike($book->id))
                                <form action="{{ route('likes.destroy', $book->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="like" style="background: pink">&hearts;</button>
                                </form>
                            @else
                                <form action="{{ route('likes.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="like" style="background: pink">&#9825;</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </td>
                @if (Auth::user()->isAdmin())
                    {{-- 管理者にカートボタンを表示させない --}}
                @else
                    <td>
                        <div style="display: flex; align-items:center;">
                            @if (!$book->isRentable($book->id))
                                貸出中
                            @elseif(Auth::user()->isInCart($book->id))
                                追加済
                            @else
                                <form action="{{ route('carts.store') }}" method="post">
                                    @csrf
                                    {{-- <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"> --}}
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <input type="submit" value="追加">
                                </form>
                            @endif
                        </div>
                    </td>
                @endif
            </tr>
        @endforeach
    </table>
    {{ $books->appends(Request::all())->links() }}
@endsection
