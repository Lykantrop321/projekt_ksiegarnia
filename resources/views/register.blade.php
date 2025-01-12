<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
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
