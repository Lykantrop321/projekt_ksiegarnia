<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function confirmOrder($id)
    {
        $order = Order::find($id);
        if ($order) {
            // Tutaj można dodać logikę potwierdzenia zamówienia
            return redirect()->route('worker')->with('success', 'Zamówienie zostało potwierdzone.');
        }
        return back()->with('error', 'Zamówienie nie znalezione.');
    }

    public function rejectOrder($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return back()->with('error', 'Zamówienie nie znalezione.');
        }

        try {
            DB::transaction(function () use ($order) {
                // Usuwamy wszystkie powiązane elementy zamówienia
                $order->orderItems()->delete();
                // Następnie usuwamy samo zamówienie
                $order->delete();
            });
            return redirect()->route('worker')->with('success', 'Zamówienie odrzucone.');
        } catch (\Exception $e) {
            return back()->with('error', 'Nie udało się odrzucić zamówienia: ' . $e->getMessage());
        }
    }
}
