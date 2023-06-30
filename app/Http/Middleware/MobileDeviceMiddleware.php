<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MobileDeviceMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $isMobileApp = $request->hasHeader('app-version');
        if (!$isMobileApp) {
            return $next($request);
        }

        if (!$request->user()) {
            return $next($request);
        }

        if ($request->hasHeader('x-device')) {
            $device = $request->headers->get('x-device');
            $encodedDevice = base64_decode($device);


            var_dump($encodedDevice);
            die;
        }

        return $next($request);
    }
}
