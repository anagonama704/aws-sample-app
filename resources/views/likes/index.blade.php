
@extends('layouts.app')
@section('content')
<table border="1">
    <tr>
        <th>詳細</th>
        <th>書籍名</th>
        <th>出版社</th>
        <th>カテゴリ</th>
        <th>お気に入り</th>
    </tr>
    @foreach ($books as $book)
        <tr>
            <td>
                @if (empty($book->image))
                    <img style="display: block; margin: auto;" src="{{ asset('image\sample_book.png') }}">
                @else
                    <img style="display: block; margin: auto;" src=" {{ asset('storage/' . $book->image) }}">
                @endif
            </td>
            <td><a href="{{ route('books.show', $book) }}">{{ $book->name }}</a></td>
            <td>{{ $book->publisher }}</td>
            <td>{{ $book->category->name }}</td>
            <td>
                @if (!empty(\Auth::user()->likeBooks()->find($book->id)))
                    <form action="{{ route('likes.destroy', $book) }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit" class="like" style="background: pink">&hearts;</button>
                    </form>
                @else
                    <form action="{{ route('likes.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit" class="like" style="background: pink">&#9825;</button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
</table>
@endsection
