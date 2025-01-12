{{-- resources/views/klienci/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista klientów</title>
</head>
<body>
    <h1>Lista klientów</h1>
    @foreach ($klienci as $klient)
        <p>{{ $klient->imie }} {{ $klient->nazwisko }}</p>
    @endforeach
</body>
</html>
