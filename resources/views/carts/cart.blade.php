<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Koszyk</title>
    <link rel="stylesheet" href="style.css"> <!-- Załóżmy, że masz jakiś plik CSS -->
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
