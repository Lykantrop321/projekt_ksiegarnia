@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dodaj Pracownika</h1>
    <form action="{{ route('pracownicy.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Imię:</label>
            <input type="text" class="form-control" name="imie" required>
        </div>
        <div class="form-group">
            <label for="nazwisko">Nazwisko:</label>
            <input type="text" class="form-control" name="nazwisko" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Zapisz</button>
    </form>
</div>
@endsection
