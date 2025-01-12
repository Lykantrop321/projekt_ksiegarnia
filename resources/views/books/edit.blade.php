{{-- resources/views/books/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edytuj książkę</h1>
    <form action="{{ route('books.update', ['book' => $book->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Tytuł:</label>
            <input type="text" class="form-control" name="title" value="{{ $book->title }}" required>
        </div>
        <div class="form-group">
            <label for="author">Autor:</label>
            <input type="text" class="form-control" name="author" value="{{ $book->author }}" required>
        </div>
        <div class="form-group">
            <label for="price">Cena:</label>
            <input type="number" class="form-control" name="price" value="{{ $book->price }}" required>
        </div>
        <div class="form-group">
            <label for="quantity">Ilość:</label>
            <input type="number" class="form-control" name="quantity" value="{{ $book->quantity }}" required min="0">
        </div>
        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
    </form>
</div>
@endsection
