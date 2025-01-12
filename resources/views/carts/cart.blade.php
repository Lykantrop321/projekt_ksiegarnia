<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Koszyk</title>
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
    <div class="container">
        <h1>Koszyk</h1>
        <table>
            <thead>
                <tr>
                    <th>Nazwa książki</th>
                    <th>Ilość</th>
                    <th>Cena jednostkowa</th>
                    <th>Suma</th>
                    <th>Usuń</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $item)
                    <tr>
                        <td>{{ $item->book->title }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->book->price, 2) }} zł</td>
                        <td>{{ number_format($item->quantity * $item->book->price, 2) }} zł</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Usuń</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 20px;">
            <form action="{{ route('cart.confirm') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Dokonaj rezerwacji</button>
            </form>
        </div>
        <a href="/books">Przejdź do listy książek</a>
    </div>
</body>
</html>
