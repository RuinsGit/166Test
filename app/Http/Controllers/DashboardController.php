<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // İstatistikleri hazırla
        $statistics = [
            'total_orders' => Order::where('user_id', Auth::id())->count(),
            'total_products' => Product::count(),
            'pending_orders' => Order::where('user_id', Auth::id())
                                   ->where('status', 'pending')
                                   ->count(),
            'completed_orders' => Order::where('user_id', Auth::id())
                                     ->where('status', 'completed')
                                     ->count()
        ];

        // Son siparişler
        $orders = Order::where('user_id', Auth::id())
                      ->latest()
                      ->take(5)
                      ->get();

        // Son ürünler
        $recentProducts = Product::latest()
                               ->take(4)
                               ->get();

        return view('dashboard', compact('statistics', 'orders', 'recentProducts'));
    }
} 