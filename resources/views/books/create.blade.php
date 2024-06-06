@extends('layouts.app')

@section('content')
    <h1>書籍登録</h1>
    @include('commons.flash')
    <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <dl>
            <dt>書籍名</dt>
            <dd><input type="text" name="name" value="{{ old('name') }}"></dd>
            <dt>著者</dt>
            <dd><input type="text" name="author" value="{{ old('author') }}"></dd>
            <dt>出版社</dt>
            <dd><input type="text" name="publisher" value="{{ old('publisher') }}"></dd>
            <dt>カテゴリ</dt>
            <dd>
                <select name="category_id">
                @foreach($categories as $category)
                    <option value= "{{$category->id}}" @if ($book->category_id == $category->id) selected @endif >{{ $category->name }}</option>
                @endforeach
                </select>
            </dd>
            <dt>概要</dt>
            <dd><textarea name="description">{{ old('description') }}</textarea></dd>
            <dt>画像</dt>
            <dd><input type="file" name="file" id="file" accept=".png,.jpg,.jpeg"></dd>
        <button type="submit">作成</button>
    </form>
@endsection
