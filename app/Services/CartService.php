<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;

class CartService
{
    protected $session;
    protected $items;

    public function __construct()
    {
        $this->session = app(SessionManager::class);
        $this->items = collect($this->session->get('cart', []));
    }

    public function add(Product $product, $quantity = 1)
    {
        $item = $this->items->get($product->id);

        if ($item) {
            $item['quantity'] += $quantity;
        } else {
            $item = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image
            ];
        }

        $this->items->put($product->id, $item);
        $this->save();
    }

    public function update($productId, $quantity)
    {
        if ($quantity <= 0) {
            $this->remove($productId);
            return;
        }

        if ($item = $this->items->get($productId)) {
            $item['quantity'] = $quantity;
            $this->items->put($productId, $item);
            $this->save();
        }
    }

    public function remove($productId)
    {
        $this->items->forget($productId);
        $this->save();
    }

    public function clear()
    {
        $this->items = collect();
        $this->save();
    }

    public function items()
    {
        return $this->items;
    }

    public function count()
    {
        return $this->items->sum('quantity');
    }

    public function total()
    {
        return $this->items->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    protected function save()
    {
        $this->session->put('cart', $this->items->toArray());
    }
} 