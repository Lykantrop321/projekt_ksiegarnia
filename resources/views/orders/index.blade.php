@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Zamówienia</h1>
    @forelse ($orders as $order)
        <div>Zamówienie #{{ $order->id }} - {{ $order->status }} - ${{ $order->total }}</div>
    @empty
        <p>Nie masz jeszcze żadnych zamówień.</p>
    @endforelse
</div>
@endsection
