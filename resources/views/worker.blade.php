<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Pracownika</title>
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
    <h1>Panel Pracownika</h1>
    @auth
        @if(Auth::user()->hasRole('Worker'))
            <p>Witaj, {{ Auth::user()->name }}! Masz dostęp jako Pracownik.</p>

            <h2>Lista Książek</h2>
            <ul>
                @foreach ($books as $book)
                    <li>
                        <strong>{{ $book->title }}</strong> by {{ $book->author }} - {{ $book->price }} zł, Dostępnych: {{ $book->quantity }}
                        <form method="POST" action="{{ route('books.update', $book) }}">
                            @csrf
                            @method('PUT')
                            <input type="text" name="title" value="{{ $book->title }}" required>
                            <input type="text" name="author" value="{{ $book->author }}" required>
                            <input type="number" name="price" value="{{ $book->price }}" required step="0.01">
                            <input type="number" name="quantity" value="{{ $book->quantity }}" required min="0">
                            <button type="submit">Zaktualizuj</button>
                        </form>
                        <form method="POST" action="{{ route('books.destroy', $book) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Czy na pewno chcesz usunąć tę książkę?')">Usuń</button>
                        </form>
                    </li>
                @endforeach
            </ul>

            <h2>Dodaj nową książkę</h2>
            <form action="{{ route('books.store') }}" method="POST">
                @csrf
                <label for="title">Tytuł:</label>
                <input type="text" name="title" id="title" required><br>
                <label for="author">Autor:</label>
                <input type="text" name="author" id="author" required><br>
                <label for="price">Cena:</label>
                <input type="number" name="price" id="price" required step="0.01"><br>
                <label for="quantity">Ilość:</label>
                <input type="number" name="quantity" id="quantity" required min="0"><br>
                <button type="submit">Dodaj książkę</button>
            </form>

            <h2>Zamówienia do potwierdzenia</h2>
            <ul>
                @foreach ($orders as $order)
                    <li>
                        Numer zamówienia: {{ $order->order_number }} - Łączna suma: {{ $order->total_price }} zł
                        <a href="{{ route('order.details', ['id' => $order->id]) }}">Szczegóły zamówienia</a>
                        <form method="POST" action="{{ route('orders.confirm', $order->id) }}">
                            @csrf
                            <button type="submit">Potwierdź zamówienie</button>
                        </form>
                        <form method="POST" action="{{ route('orders.reject', $order->id) }}">
                            @csrf
                            <button type="submit">Odrzuć zamówienie</button>
                        </form>
                    </li>
                @endforeach
            </ul>
            

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Wyloguj</button>
            </form>
        @else
            <p>Nie masz dostępu do tej sekcji. Proszę</p>
        @endif
    @endauth
</body>
</html>
