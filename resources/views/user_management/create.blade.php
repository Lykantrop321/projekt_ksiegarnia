{{-- resources/views/user_management/create.blade.php --}}
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Nowy użytkownik</title>
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
