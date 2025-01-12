{{-- resources/views/user_management/create.blade.php --}}
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Nowy użytkownik</title>
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
@if(auth()->check() && auth()->user()->hasRole('Admin'))

    <h1>Tworzenie nowego użytkownika</h1>
    <form action="{{ route('user_management.store') }}" method="post">
        @csrf
        <label for="name">Imię:</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required>
        <label for="roles">Role:</label>
        <select name="roles[]" multiple>
            @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
        <button type="submit">Zapisz</button>
    </form>
    @else
    <p>Nie masz uprawnień do przeglądania tej strony.</p>
    @endif
</body>
</html>
