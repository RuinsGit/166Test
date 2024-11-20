<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CartService;

class CartServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('cart', function ($app) {
            return new CartService();
        });
    }
} 