<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Użytkownika</title>
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
    <h1>Panel Użytkownika</h1>
    <p>Witaj, {{ Auth::user()->name }}! Masz dostęp jako Użytkownik.</p>
    <a href="/cart">Twój Koszyk</a>
    <a href="/orders">Twoje Zamówienia</a>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Wyloguj</button>
    </form>
</body>
</html>
