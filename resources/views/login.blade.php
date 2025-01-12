<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
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
