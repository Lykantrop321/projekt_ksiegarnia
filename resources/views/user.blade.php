<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Użytkownika</title>
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
