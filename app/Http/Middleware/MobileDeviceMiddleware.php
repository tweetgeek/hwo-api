<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class MobileDeviceMiddleware
{
    public const EXCLUDED = [
        'sanctum/csrf-cookie',
        'login'
    ];

    /**
     * @throws AuthenticationException
     */
    public function handle(Request $request, Closure $next)
    {
        $isMobileApp = $request->hasHeader(config('mobile.app_version_header'));
        if (!$isMobileApp || in_array($request->path(), self::EXCLUDED)) {
            return $next($request);
        }

        if (!$request->user()) {
            return $next($request);
        }

        $deviceId = $request->header(config('mobile.device_info_id_header'));
        if (!$deviceId || !$request->user()->userDevices()->find($deviceId) || $request->session()->get(config('mobile.device_info_id_header')) !== $deviceId) {
            $request->session()->invalidate();
            throw new AuthenticationException;
        }

        return $next($request);
    }
}
