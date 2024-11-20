<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        $total = 0;

        foreach($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Product $product)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->image
            ];
        }
        
        session()->put('cart', $cart);

        if(request()->ajax()) {
            return response()->json([
                'message' => 'Ürün sepete eklendi',
                'cartCount' => count($cart)
            ]);
        }

        return redirect()->back()->with('success', 'Ürün sepete eklendi!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'total' => $this->getCartTotal(),
            'cartCount' => $this->getCartCount()
        ]);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Ürün sepetten kaldırıldı!');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Sepet temizlendi!');
    }

    private function getCartTotal()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return $total;
    }

    private function getCartCount()
    {
        $cart = session()->get('cart', []);
        $count = 0;
        
        foreach($cart as $item) {
            $count += $item['quantity'];
        }
        
        return $count;
    }
} 