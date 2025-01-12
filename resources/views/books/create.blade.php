{{-- resources/views/books/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dodaj książkę</h1>
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Tytuł:</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="form-group">
            <label for="author">Autor:</label>
            <input type="text" class="form-control" name="author" required>
        </div>
        <div class="form-group">
            <label for="price">Cena:</label>
            <input type="number" class="form-control" name="price" required>
        </div>
        <div class="form-group">
            <label for="quantity">Ilość:</label>
            <input type="number" class="form-control" name="quantity" required min="0">
        </div>
        <button type="submit" class="btn btn-primary">Zapisz</button>
    </form>
</div>
@endsection
