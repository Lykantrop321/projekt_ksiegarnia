<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
    <a href="{{ route('home') }}" id="home-button">Strona główna</a> 
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
        <h1>Rejestracja</h1>
        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <input type="text" name="name" placeholder="Imię" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Hasło" required>
            <input type="password" name="password_confirmation" placeholder="Potwierdź Hasło" required>
            <button type="submit">Zarejestruj</button>
        </form>
        <a href="{{ route('login') }}">Logowanie</a>
    </div>
</body>
</html>
