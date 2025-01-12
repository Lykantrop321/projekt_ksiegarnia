{{-- resources/views/books/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Szczegóły książki</h1>
    <div class="card">
        <div class="card-header">
            {{ $book->title }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Autor: {{ $book->author }}</h5>
            <p class="card-text">Cena: ${{ number_format($book->price, 2) }}</p>
            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Edytuj</a>
            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć tę książkę?')">Usuń</button>
            </form>
        </div>
    </div>
</div>
@endsection
