<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Admina</title>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
@if(auth()->check() && auth()->user()->hasRole('Admin'))

    <h1>Panel Admina</h1>
    <p>Witaj, {{ Auth::user()->name }}! Masz dostęp jako Admin.</p>

    <!-- Link do zarządzania użytkownikami -->
    <div>
        <a href="{{ route('user_management.index') }}">Zarządzaj Użytkownikami</a>
    </div>

    <!-- Formularz wylogowania -->
    <div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Wyloguj</button>
        </form>
    </div>
    @else
    <p>Nie masz uprawnień do przeglądania tej strony.</p>
    @endif
</body>
</html>
