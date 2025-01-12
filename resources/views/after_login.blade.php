<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Strona Po Zalogowaniu</title>
    <h1>Witaj na stronie po zalogowaniu!</h1>
    <br><!-- Styles -------------------------------------------------------------------->
        <button onclick="speakText()">Mów</button>
    <button onclick="stopSpeaking()">Zatrzymaj</button>
    <select id="style-selector">
        <option value="main">Standardowy</option>
        <option value="daltonism">Dla daltonistów</option>
        <option value="mono">Wysoki kontrast</option>
    </select>
    <button onclick="changeFontSize('increase')">Zwiększ czcionkę</button>
    <button onclick="changeFontSize('decrease')">Zmniejsz czcionkę</button>
    <link id="theme-style" href="{{ asset('css/main.css') }}" rel="stylesheet">
    <script src="{{ asset('js/themeSwitcher.js') }}"></script>
    <!-- Styles ------------------------------------------------------------------------>
</head>
<body>
    <div>
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
