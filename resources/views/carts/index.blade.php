@extends('layouts.app')
@section('content')
    <h1>カート一覧</h1>
    <table border="1">
        <tr>
            {{-- <th>ID</th> --}}
            <th>表紙</th>
            <th>書籍名</th>
            <th>著者</th>
            <th></th>
        </tr>
        @foreach ($carts as $cart)
            <tr>
                <td>
                    @if (empty($cart->book->image))
                        <img style="display: block; margin: auto;" src="{{ asset('image\sample_book.png') }}">
                    @else
                        <img style="display: block; margin: auto;" src=" {{ asset('storage/' . $cart->book->image) }}">
                    @endif
                </td>
                <td><a href="{{ route('books.show', $cart->book) }}">{{ $cart->book->name }}</a></td>
                <td>{{ $cart->book->author }}</td>
                <td><button href="#" onclick="deleteCart({{ $cart->id }})">削除</button></td>
            </tr>
            <form action="{{ route('carts.destroy', $cart) }}" method="post" id="{{ 'delete-cart' . $cart->id }}">
                @csrf
                @method('delete')
                <input type="hidden" name="book_id" value="{{ $cart->book->id }}">
            </form>
        @endforeach
    </table>
    <script type="text/javascript">
        function deleteCart(id) {
            event.preventDefault();
            if (window.confirm('本当に削除しますか?')) {
                document.getElementById('delete-cart' + id).submit();
            }
        }
    </script>

    {{ $carts->links() }}
    <button href="#" onclick="createOrder()">注文</button>
    <form action="{{ route('rentals.store') }}" method="post" id='create-order'>
        @csrf
    </form>

    <script type="text/javascript">
        function createOrder() {
            event.preventDefault();
            if (window.confirm('本当に注文しますか?')) {
                document.getElementById('create-order').submit();
            }
        }
    </script>
@endsection
