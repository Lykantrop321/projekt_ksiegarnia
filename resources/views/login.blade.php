<!DOCTYPE html>
<html lang="pl">
    <meta charset="UTF-8">
    <title>Logowanie</title>
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
        <h1>Logowanie</h1>
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
            @if ($errors->has('email'))
                <div style="color: red;">{{ $errors->first('email') }}</div>
            @endif
            <input type="password" name="password" placeholder="Hasło" required>
            @if ($errors->has('password'))
                <div style="color: red;">{{ $errors->first('password') }}</div>
            @endif
            <button type="submit">Zaloguj</button>
        </form>
        <a href="{{ route('register') }}">Rejestracja</a>
    </div>
</body>
</html>
