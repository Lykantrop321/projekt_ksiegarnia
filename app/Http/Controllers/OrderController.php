<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function confirmOrder($id)
    {
        $order = Order::with('orderItems.book')->find($id);
        if (!$order) {
            return back()->with('error', 'Zamówienie nie znalezione.');
        }

        try {
            DB::transaction(function () use ($order) {
                foreach ($order->orderItems as $item) {
                    $book = $item->book;
                    if ($book) {
                        $book->quantity -= $item->quantity;
                        $book->save();
                    }
                }
                // Optionally mark the order as confirmed if you have a status field
                // $order->status = 'Confirmed';
                // $order->save();
            });
            return redirect()->route('worker')->with('success', 'Zamówienie zostało potwierdzone i stany magazynowe zaktualizowane.');
        } catch (\Exception $e) {
            return back()->with('error', 'Nie udało się potwierdzić zamówienia: ' . $e->getMessage());
        }
    }

    public function rejectOrder($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return back()->with('error', 'Zamówienie nie znalezione.');
        }

        try {
            DB::transaction(function () use ($order) {
                $order->orderItems()->delete();
                $order->delete();
            });
            return redirect()->route('worker')->with('success', 'Zamówienie odrzucone.');
        } catch (\Exception $e) {
            return back()->with('error', 'Nie udało się odrzucić zamówienia: ' . $e->getMessage());
        }
    }

    public function showOrderDetails($id)
    {
        $order = Order::with('orderItems.book')->find($id);
        if (!$order) {
            return back()->with('error', 'Zamówienie nie znalezione.');
        }
        
        return view('order_details', compact('order'));
    }
}
