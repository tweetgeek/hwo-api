<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class MobileAppVersion extends Middleware
{
    public function handle(Request $request, Closure $next)
    {
        $passedAppVersion = $request->header('App-Version');
        if ($passedAppVersion !== '0.0.1') {
            dd('wrong app version');

            return response()->json(['message' => 'aaa'], 222);
        }

        return $next($request);
    }
}
