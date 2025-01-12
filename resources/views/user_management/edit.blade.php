{{-- resources/views/user_management/edit.blade.php --}}
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edycja użytkownika</title>
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

    <h1>Edycja użytkownika</h1>
    <form action="{{ route('user_management.update', $user->id) }}" method="post">
        @csrf
        @method('PUT')
        <label for="name">Imię:</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required>
        <label for="roles">Role:</label>
        <select name="roles[]" multiple>
            @foreach ($roles as $role)
            <option value="{{ $role->id }}" @if($user->roles->contains($role)) selected @endif>{{ $role->name }}</option>
            @endforeach
        </select>
        <button type="submit">Aktualizuj</button>
    </form>
    @else
    <p>Nie masz uprawnień do przeglądania tej strony.</p>
    @endif
</body>
</html>
