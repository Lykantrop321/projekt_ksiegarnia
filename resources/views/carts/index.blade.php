<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Koszyk</title>
    <a href="{{ route('after_login') }}" id="home-button">Strona główna</a> 
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
    @auth
        @if(Auth::user()->hasRole('User'))
            @if($carts->isEmpty())
                <p>Koszyk jest pusty.</p>
            @else
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
                        @foreach($carts as $cart)
                        <tr>
                            <td>{{ $cart->book->title }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>{{ number_format($cart->book->price, 2) }} zł</td>
                            <td>{{ number_format($cart->quantity * $cart->book->price, 2) }} zł</td>
                            <td>
                                <form method="POST" action="{{ route('cart.remove', $cart->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Usuń</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" style="text-align: right;">
                                <form method="POST" action="{{ route('cart.checkout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Dokonaj rezerwacji</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endif
        @else
            <p>Nie masz dostępu do tej sekcji.</p>
        @endif
    @endauth

    <a href="/books">Przejdź do listy książek</a>
</div>
<p id="order-info">Twoje zamówienie zostanie zrealizowane w ciągu 24h. Powiadomimy Cię SMS-em, kiedy zamówienie będzie do odbioru.</p>
</body>
</html>
