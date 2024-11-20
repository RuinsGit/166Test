<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'items.product');
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        \Log::info('Order ID: ' . $order->id);
        \Log::info('Order Items: ' . $order->items);
        
        $order->load(['items.product', 'user']);
        
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,canceled']
        ]);

        try {
            $order->update([
                'status' => $validated['status']
            ]);

            return redirect()->back()->with('success', 'Sifariş statusu uğurla yeniləndi!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Status yenilənərkən xəta baş verdi: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function getStatusEnum()
    {
        $enumValues = DB::select("SHOW COLUMNS FROM orders WHERE Field = 'status'");
        return $enumValues;
    }
}
