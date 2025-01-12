<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Szczegóły zamówienia</title>
    <a href="{{ route('worker') }}" id="home-button">Strona główna</a> 
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
@auth
@if(Auth::user()->hasRole('Worker'))
    <h1>Szczegóły zamówienia {{ $order->order_number }}</h1>
    <ul>
        @foreach ($order->orderItems as $item)
            <li>{{ $item->book->title }} - Ilość: {{ $item->quantity }}, Cena jednostkowa: {{ $item->unit_price }} zł</li>
        @endforeach
    </ul>
    <a href="{{ route('worker') }}">Powrót do panelu pracownika</a>
    </form>
        @else
            <p>Nie masz dostępu do tej sekcji.</p>
        @endif
    @endauth
</body>
</html>
