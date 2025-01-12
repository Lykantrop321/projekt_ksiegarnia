<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Strona Po Zalogowaniu</title>
</head>
<body>
    <div>
        <h1>Witaj na stronie po zalogowaniu!</h1>
        <p>Przypisane role: {{ implode(', ', Auth::user()->getRoleNames()->toArray()) }}</p>
        @auth
            <p>Witaj, {{ Auth::user()->name }}! Zostałeś pomyślnie zalogowany.</p>

            @if(Auth::user()->hasRole('Admin'))
                <h2>Sekcja Administracyjna</h2>
                <a href="/pracownicy">Lista Pracowników</a>
                <a href="/books">Lista Książek</a>
            @elseif(Auth::user()->hasRole('Worker'))
                <h2>Sekcja dla Pracowników</h2>
                <a href="/books/create">Dodaj Książkę</a>
            @elseif(Auth::user()->hasRole('User'))
                <h2>Sekcja dla Użytkowników</h2>
                <a href="/cart">Twój Koszyk</a>
                <a href="{{ url('/books') }}">Zobacz listę książek</a>

            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Wyloguj</button>
            </form>
        @endauth
    </div>
</body>
</html>
