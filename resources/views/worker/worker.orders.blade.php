<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zamówienia</title>
</head>
<body>
<h1>Zamówienia</h1>
<ul>
    @foreach ($orders as $order)
        <li>{{ $order->order_number }} - Łączna suma: {{ $order->total_price }} zł</li>
    @endforeach
</ul>
</body>
</html>
