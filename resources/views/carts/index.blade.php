<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Koszyk</title>
    <link rel="stylesheet" href="/css/app.css"> <!-- Upewnij się, że ta ścieżka jest poprawna! -->
</head>
<body>
<div class="container">
    <h1>Koszyk</h1>
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
    <a href="/books">Przejdź do listy książek</a>
</div>
</body>
</html>
