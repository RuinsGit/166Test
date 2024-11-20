<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderController extends Controller
{
    public function create()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('products.index')
                ->with('error', 'Səbətiniz boşdur!');
        }

        return view('orders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:1000'
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Səbətiniz boşdur!');
        }

        try {
            DB::beginTransaction();

            // Toplam tutarı hesapla
            $totalAmount = 0;
            foreach ($cart as $item) {
                $totalAmount += $item['price'] * $item['quantity'];
            }

            // Siparişi oluştur
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $totalAmount,
                'shipping_address' => $validated['shipping_address'],
                'billing_address' => $validated['shipping_address'],
                'phone' => $validated['phone'],
                'notes' => $validated['notes'] ?? null,
                'status' => 'pending'
            ]);

            // Sipariş ürünlerini ekle
            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            // Sepeti temizle
            session()->forget('cart');

            DB::commit();

            return redirect()->route('orders.show', $order)
                ->with('success', 'Sifarişiniz uğurla yaradıldı!');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Order creation error: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Sifariş yaradılarkən xəta baş verdi: ' . $e->getMessage());
        }
    }

    public function show(Order $order)
    {
        // Kullanıcı yetkisi kontrolü
        if (!auth()->user()->isAdmin() && auth()->id() !== $order->user_id) {
            abort(403);
        }

        $order->load('items.product');
        
        return view('orders.show', compact('order'));
    }

    public function index()
    {
        $orders = auth()->user()->isAdmin() 
            ? Order::with('user')->latest()->paginate(10)
            : auth()->user()->orders()->latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        // Admin kontrolü
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,approved,canceled'
        ]);

        $order->update(['status' => $validated['status']]);

        return redirect()->back()
            ->with('success', 'Sifariş statusu yeniləndi.');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Səbətiniz boşdur!');
        }

        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('orders.checkout', compact('cart', 'total'));
    }
}
