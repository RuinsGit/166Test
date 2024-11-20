<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        if (!Auth::check()) {
            return redirect()->route('admin.loginForm');
        }


        if (!Auth::user()->isAdmin()) {
            Auth::logout();
            return redirect()->route('admin.loginForm')->withErrors([
                'email' => 'Bu alana sadece adminler giriş yapabilir.',
            ]);
        }

        return $next($request);
    }
}
