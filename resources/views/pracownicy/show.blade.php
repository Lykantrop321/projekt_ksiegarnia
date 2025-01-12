treść dla show.blade.php
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Szczegóły Pracownika</h1>
    <ul>
        <li>Imię: {{ $pracownik->name }}</li>
        <li>Email: {{ $pracownik->email }}</li>
    </ul>
</div>
@endsection
