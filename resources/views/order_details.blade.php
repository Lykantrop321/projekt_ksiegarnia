<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Szczegóły zamówienia</title>
</head>
<body>
    <h1>Szczegóły zamówienia {{ $order->order_number }}</h1>
    <ul>
        @foreach ($order->orderItems as $item)
            <li>{{ $item->book->title }} - Ilość: {{ $item->quantity }}, Cena jednostkowa: {{ $item->unit_price }} zł</li>
        @endforeach
    </ul>
    <a href="{{ route('worker') }}">Powrót do panelu pracownika</a>
</body>
</html>
