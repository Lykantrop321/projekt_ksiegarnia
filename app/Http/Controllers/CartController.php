<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use DB;

class CartController extends Controller
{
    public function addToCart(Request $request, $bookId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('user_id', auth()->user()->id)
                     ->where('book_id', $bookId)
                     ->first();

        if ($cart) {
            $cart->quantity += $validated['quantity'];
        } else {
            $cart = new Cart([
                'user_id' => auth()->user()->id,
                'book_id' => $bookId,
                'quantity' => $validated['quantity']
            ]);
        }

        $cart->save();

        return back()->with('success', 'Książka dodana do koszyka!');
    }

    public function showCart()
    {
        $carts = Cart::with('book')->where('user_id', auth()->user()->id)->get();
        return view('carts.index', ['carts' => $carts]);
    }

    public function removeFromCart($cartId)
    {
        $cart = Cart::find($cartId);

        if ($cart && $cart->user_id == auth()->user()->id) {
            $cart->delete();
            return back()->with('success', 'Pozycja usunięta z koszyka.');
        } else {
            return back()->with('error', 'Nie udało się usunąć pozycji z koszyka.');
        }
    }

    public function placeOrder(Request $request)
    {
        $user_id = auth()->user()->id;
        $cartItems = Cart::where('user_id', $user_id)->get();

        DB::transaction(function () use ($cartItems, $user_id) {
            $order = new Order();
            $order->user_id = $user_id;
            $order->order_number = uniqid('Order-');
            $order->total_price = $cartItems->sum(function ($item) {
                return $item->quantity * $item->book->price;
            });
            $order->save();

            foreach ($cartItems as $item) {
                $order->orderItems()->create([
                    'book_id' => $item->book_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->book->price
                ]);
            }

            Cart::where('user_id', $user_id)->delete();
        });

        return redirect()->route('cart.show')->with('success', 'Zamówienie złożone pomyślnie.');
    }
}
