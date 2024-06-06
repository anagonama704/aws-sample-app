@extends('layouts.app')

@section('content')
    <h1>書籍詳細</h1>
    <div style="display: flex">
        @if (empty($book->image))
            <img src="{{ asset('image\sample_book.png') }}">
        @else
            <img src=" {{ asset('storage/' . $book->image) }}">
        @endif
        <div>
            <table border="1">
                <tr>
                    <th>書籍名</th>
                    <td>{{ $book->name }}</td>
                </tr>
                <tr>
                    <th>著者</th>
                    <td>{{ $book->author }}</td>
                </tr>
                <tr>
                    <th>出版社</th>
                    <td>{{ $book->publisher }}</td>
                </tr>
                <tr>
                    <th>カテゴリー</th>
                    <td>{{ $book->category->name }}</td>
                </tr>
                <tr>
                    <th>概要</th>
                    <td>{!! nl2br($book->description) !!}</td>
                </tr>
            </table>
            @if (Auth::check() && Auth::user()->is_admin)
                <div style="display: flex">
                    <button onclick="location.href='{{ route('books.edit', $book->id) }}'">編集する</button>
                    <form id="delete_books" action="{{ route('books.destroy', $book->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="button" onclick="delete_btn()">削除する</button>
                    </form>
                </div>
        </div>
    </div>
@elseif(Auth::check() && !Auth::user()->is_admin)
    {{-- 会員の場合はカートに追加するボタンを表示 --}}
    @if (!$book->isRentable($book->id))
        <button disabled class="cart">貸出中</button><br>
    @elseif(Auth::user()->isInCart($book->id))
        <button disabled class="cart">カートに追加済</button><br>
    @else
        <button href="#" onclick="cart_btn()">カートに追加</button>
        <form id="cart_books" action="{{ route('carts.store') }}" method="post">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            {{-- <input type="submit" value="カートに追加"> --}}
        </form>
    @endif
    @endif
    <script>
        function delete_btn() {
            event.preventDefault();
            if (confirm('本当に削除しますか？')) {
                document.getElementById('delete_books').submit()
            }
        }

        function cart_btn() {
            event.preventDefault();
            if (confirm('本当にカートに入れますか？')) {
                document.getElementById('cart_books').submit()
            }
        }
    </script>
@endsection
