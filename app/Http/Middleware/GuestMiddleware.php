<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GuestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (\Auth::user()) {
            return response()->json([], Response::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }
}
