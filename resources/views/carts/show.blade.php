@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Koszyk</h1>
    <table>
        <thead>
            <tr>
                <th>Tytuł</th>
                <th>Ilość</th>
                <th>Cena jednostkowa</th>
                <th>Suma</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $item)
            <tr>
                <td>{{ $item->book->title }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->book->price, 2) }} PLN</td>
                <td>{{ number_format($item->quantity * $item->book->price, 2) }} PLN</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
