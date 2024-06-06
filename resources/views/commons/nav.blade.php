<ul class="navigation">
@if (Auth::check())
    <li><button class="nav_button"><i class="emoji">📚</i><a href="{{ route('books.index') }}">書籍一覧</a></button></li>
    <li><button class="nav_button"><i class="emoji">🛍️</i><a href="{{ route('rentals.index') }}">レンタル一覧</a></button></li>
    @if (Auth::user()->isAdmin())
        <li><button class="nav_button"><i class="emoji">👯‍♀️</i><a href="{{ route('users.index') }}">ユーザ一覧</a></button></li>
    @else
        <li><button class="nav_button"><i class="emoji">❤️</i><a href="{{ route('likes.index') }}">お気に入り一覧</a></button></li>
        <li><button class="nav_button"><i class="emoji">🛒</i><a href="{{ route('carts.index') }}">カート</a></button></li>
        <li><button class="nav_button"><i class="emoji">👽</i><a href="{{ route('users.show', Auth::user()) }}">マイページ</a></button></li>
    @endif
    <li><button class="nav_button"><i class="emoji">🛸</i><a href="#" onclick="logout()">ログアウト</a></button></li>
@else
    @if (Route::has('register'))
        <li><button class="nav_button"><i class="emoji">🤖</i><a href="{{ route('register') }}">新規会員登録</a></button></li>
    @endif
    <li><button class="nav_button"><i class="emoji">🌐</i><a href="{{ route('login') }}">ログイン</a></button></li>
@endif
</ul>

<form id="logout-form" action="{{ route('logout') }}" method="post">
    @csrf
</form>
<script type="text/javascript">
    function logout(){
        event.preventDefault();
        if (window.confirm('ログアウトしますか？')) {
            document.getElementById('logout-form').submit();
        }
    }
</script>
