<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Lista książek</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f4f4f4;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px 0 rgba(0,0,0,0.1);
        }
        .cart-link {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: red;
            color: white;
            padding: 5px 10px;
            border-radius: 10px;
            text-decoration: none;
        }
    </style>
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
