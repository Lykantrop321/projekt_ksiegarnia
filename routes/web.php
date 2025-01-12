<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookListController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.post');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.post');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/after_login', function () {
    if (Auth::check()) {
        if (Auth::user()->hasRole('Admin')) {
            return redirect('/admin');
        } elseif (Auth::user()->hasRole('Worker')) {
            return redirect('/worker');
        }
        return view('after_login');
    }
    return redirect('/login');
})->name('after_login');

Route::get('/admin', [AdminController::class, 'index'])->middleware('auth')->name('admin');

Route::get('/worker', [BookController::class, 'workerBooks'])->middleware('auth')->name('worker');

Route::get('/profile/edit', function () {
    if (Auth::check()) {
        return view('profile.edit');
    }
    return redirect('/login');
})->name('profile.edit')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/user_management', [UserManagementController::class, 'index'])->name('user_management.index');
    Route::get('/user_management/create', [UserManagementController::class, 'create'])->name('user_management.create');
    Route::post('/user_management', [UserManagementController::class, 'store'])->name('user_management.store');
    Route::get('/user_management/{user}/edit', [UserManagementController::class, 'edit'])->name('user_management.edit');
    Route::put('/user_management/{user}', [UserManagementController::class, 'update'])->name('user_management.update');
    Route::delete('/user_management/{user}', [UserManagementController::class, 'destroy'])->name('user_management.destroy');

    Route::get('/books', [BookListController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

    Route::post('/cart/add/{book}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::delete('/cart/remove/{cartId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'placeOrder'])->name('cart.checkout');

    Route::post('/orders/confirm/{id}', [OrderController::class, 'confirmOrder'])->name('orders.confirm');
    Route::post('/orders/reject/{id}', [OrderController::class, 'rejectOrder'])->name('orders.reject');
    Route::get('/orders/details/{id}', [OrderController::class, 'showOrderDetails'])->name('order.details'); // Corrected route for showing order details
});
