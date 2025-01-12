<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookListController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.list', compact('books'));
    }
}
