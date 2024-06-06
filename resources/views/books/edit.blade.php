@extends('layouts.app')

@section('content')
    <h1>書籍編集</h1>
    @include('commons.flash')
    <form action="{{ route('books.update',$book) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <dl>
            <dt>書籍名</dt>
            <dd><input type="text" name="name" value="{{$book->name}}"></dd>
            <dt>著者</dt>
            <dd><input type="text" name="author" value="{{$book->author}}"></dd>
            <dt>出版社</dt>
            <dd><input type="text" name="publisher" value="{{$book->publisher}}"></dd>
            <dt>カテゴリ</dt>
            <dd>
                <select name="category_id">
                @foreach($categories as $category)
                    <option value= "{{$category->id}}" @if ($book->category_id == $category->id) selected @endif >{{ $category->name }}</option>
                @endforeach
                </select>
            </dd>
            <dt>概要</dt>
            <dd><textarea name="description">{!!nl2br($book->description)!!}</textarea></dd>
            <dt>画像</dt>
            <input type="hidden" name="image" value="{{ $book->image }}">
            <dd><input type="file" name="file" accept=".png,.jpg,.jpeg"></dd>
        </dl>
        <button type="submit">更新</button>
    </form>
    <a href="{{ route('books.show',$book->id) }}">戻る</a>
@endsection
