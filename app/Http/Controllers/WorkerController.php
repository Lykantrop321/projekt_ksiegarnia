<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; // Upewnij się, że masz odpowiedni model dla książek

class WorkerController extends Controller
{
    /**
     * Wyświetla listę wszystkich książek.
     */
    public function index()
    {
        $books = Book::all(); // Pobiera wszystkie książki
        return view('worker.index', compact('books'));
    }

    /**
     * Pokazuje formularz do tworzenia nowej książki.
     */
    public function create()
    {
        return view('worker.create');
    }

    /**
     * Zapisuje nową książkę w bazie danych.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'price' => 'required|numeric'
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->save();

        return redirect()->route('worker.index')->with('success', 'Book added successfully!');
    }

    /**
     * Pokazuje szczegóły pojedynczej książki.
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('worker.show', compact('book'));
    }

    /**
     * Pokazuje formularz edycji książki.
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('worker.edit', compact('book'));
    }

    /**
     * Aktualizuje szczegóły książki w bazie danych.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'price' => 'required|numeric'
        ]);

        $book = Book::findOrFail($id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->save();

        return redirect()->route('worker.index')->with('success', 'Book updated successfully!');
    }

    /**
     * Usuwa książkę z bazy danych.
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('worker.index')->with('success', 'Book deleted successfully!');
    }
}
