{{-- resources/views/user_management/index.blade.php --}}
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zarządzanie użytkownikami</title>
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

    <h1>Zarządzaj użytkownikami</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imię</th>
                <th>Email</th>
                <th>Role</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach ($user->roles as $role)
                        <span>{{ $role->name }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('user_management.edit', $user->id) }}">Edytuj</a>
                    <form action="{{ route('user_management.destroy', $user->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Usuń</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Nie masz uprawnień do przeglądania tej strony.</p>
    @endif
</body>
</html>
