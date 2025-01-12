@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1>Lista Książek</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary">Dodaj Nową Książkę</a>
    <table class="table">
        <thead>
            <tr>
                <th>Tytuł</th>
                <th>Autor</th>
                <th>Cena</th>
                <th>Ilość</th> <!-- Nowa kolumna dla ilości -->
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->price }}</td>
                <td>{{ $book->quantity }}</td> <!-- Wyświetlenie ilości książek -->
                <td>
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">Edytuj</a>
                    <form action="{{ route('books.destroy', $book) }}" method="post" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Usuń</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
