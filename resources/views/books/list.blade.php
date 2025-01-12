<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Lista książek</title>
    <style>
        
    </style>
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
    <a href="{{ route('cart.show') }}" class="cart-link">
        Koszyk ({{ \App\Models\Cart::where('user_id', Auth::id())->count() }})
    </a>
    <div class="container">
        <h1>Lista książek</h1>
        <table>
            <thead>
                <tr>
                    <th>Tytuł</th>
                    <th>Autor</th>
                    <th>Cena (PLN)</th>
                    <th>Ilość w magazynie</th>
                    <th>Dodaj do koszyka</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ number_format($book->price, 2) }}</td>
                    <td>{{ $book->quantity }}</td>
                    <td>
                        <form action="{{ route('cart.add', $book->id) }}" method="POST">
                            @csrf
                            <input type="number" name="quantity" min="1" max="{{ $book->quantity }}" value="1" style="width: 60px;">
                            <button type="submit">Dodaj</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
