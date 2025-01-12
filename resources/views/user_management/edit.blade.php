{{-- resources/views/user_management/edit.blade.php --}}
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edycja użytkownika</title>
    <a href="{{ route('admin') }}" id="home-button">Strona główna</a> 
    <br><!-- Styles -------------------------------------------------------------------->
    <button onclick="speakText()" class="btn-custom">Mów</button>
    <button onclick="stopSpeaking()" class="btn-custom">Zatrzymaj</button>
    <select id="style-selector" class="styled-select">
        <option value="main">Standardowy</option>
        <option value="daltonism">Dla daltonistów</option>
        <option value="mono">Wysoki kontrast</option>
    </select>
    <button onclick="changeFontSize('increase')" class="btn-custom">Zwiększ czcionkę</button>
    <button onclick="changeFontSize('decrease')" class="btn-custom">Zmniejsz czcionkę</button>
    <link id="theme-style" href="{{ asset('css/main.css') }}" rel="stylesheet">
    <script src="{{ asset('js/themeSwitcher.js') }}"></script>
    <!-- Styles ------------------------------------------------------------------------>
</head>
<body>
@if(auth()->check() && auth()->user()->hasRole('Admin'))

    <div class="container">
        <h1 class="text-center">Edycja użytkownika</h1>
        <form action="{{ route('user_management.update', $user->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Imię:</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" required class="input-field">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" required class="input-field">
            </div>
            <div class="form-group">
                <label for="roles" class="text-large">Role:</label>
                <select name="roles[]" multiple id="roles" class="styled-select">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" @if($user->roles->contains($role)) selected @endif>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn-custom">Aktualizuj</button>
        </form>
    </div>
@else
    <p class="text-center">Nie masz uprawnień do przeglądania tej strony.</p>
@endif
</body>
</html>
