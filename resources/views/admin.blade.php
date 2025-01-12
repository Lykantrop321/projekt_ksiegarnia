<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Admina</title>
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
