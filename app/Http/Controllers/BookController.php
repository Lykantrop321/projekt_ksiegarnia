<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;  // Upewnij się, że model Order jest zaimportowany
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function workerBooks()
    {
        if (!Auth::user()->hasRole('Worker')) {
            return redirect('/after_login')->with('error', 'Nie masz dostępu do tej sekcji.');
        }
    
        $books = Book::all();
        $orders = Order::all();  // Pobieranie zamówień
        return view('worker', compact('books', 'orders'));
    }

    public function showOrders()
    {
        if (!Auth::user()->hasRole('Worker')) {
            return redirect('/after_login')->with('error', 'Nie masz dostępu do tej sekcji.');
        }

        $orders = Order::all();
        return view('worker.orders', compact('orders'));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('Worker')) {
            return redirect('/after_login')->with('error', 'Nie masz dostępu do tej sekcji.');
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:0'
        ]);

        try {
            Book::create($validated);
            return redirect()->route('worker')->with('success', 'Książka została dodana.');
        } catch (\Exception $e) {
            Log::error('Błąd przy dodawaniu książki: ' . e->getMessage());
            return back()->withErrors('Wystąpił błąd podczas dodawania książki.');
        }
    }

    public function update(Request $request, Book $book)
    {
        if (!Auth::user()->hasRole('Worker')) {
            return redirect('/after_login')->with('error', 'Nie masz dostępu do tej sekcji.');
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:0'
        ]);

        try {
            $book->update($validated);
            return redirect()->route('worker')->with('success', 'Książka została zaktualizowana.');
        } catch (\Exception $e) {
            Log::error('Błąd przy aktualizacji książki: ' . e->getMessage());
            return back()->withErrors('Wystąpił błąd podczas aktualizacji książki.');
        }
    }

    public function destroy(Book $book)
    {
        if (!Auth::user()->hasRole('Worker')) {
            return redirect('/after_login')->with('error', 'Nie masz dostępu do tej sekcji.');
        }

        try {
            $book->delete();
            return redirect()->route('worker')->with('success', 'Książka została usunięta.');
        } catch (\Exception $e) {
            Log::error('Błąd przy usuwaniu książki: ' . e->getMessage());
            return back()->withErrors('Wystąpił błąd podczas usuwania książki.');
        }
    }
}
