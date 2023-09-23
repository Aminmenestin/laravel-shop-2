<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routes = ['profile', 'profile/orders', 'profile/address', 'profile/wishlist', 'profile/comments'];
        if (in_array($request->path(), $routes)) {
            return $next($request);
        } else {
            return abort(404);
        }
    }
}
