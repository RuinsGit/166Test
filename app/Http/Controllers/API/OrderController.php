<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderStatusUpdateRequest;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])
            ->latest()
            ->paginate(10);
            
        return new OrderCollection($orders);
    }

    public function store(OrderStoreRequest $request)
    {
        $validated = $request->validated();
        $total_amount = 0;
        $order_items = [];

        foreach ($validated['products'] as $item) {
            if ($item['quantity'] > 0) {
                $product = Product::findOrFail($item['id']);
                $total_amount += $product->price * $item['quantity'];
                $order_items[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price
                ];
            }
        }

        $order = auth()->user()->orders()->create([
            'status' => 'pending',
            'total_amount' => $total_amount
        ]);

        $order->items()->createMany($order_items);
        
        return new OrderResource($order->load('items.product'));
    }

    public function show(Order $order)
    {
        return new OrderResource($order->load('items.product'));
    }

    public function updateStatus(OrderStatusUpdateRequest $request, Order $order)
    {
        $order->update($request->validated());
        
        return new OrderResource($order->load('items.product'));
    }
}
