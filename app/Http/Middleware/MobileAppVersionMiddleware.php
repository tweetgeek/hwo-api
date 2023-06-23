<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MobileAppVersionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $isMobileApp = $request->hasHeader('app-version');
        if (!$isMobileApp) {
            return $next($request);
        }

        //hwo-app/

        $request->headers->add(['supported-app-version' => config('mobile.supported_version')]);
        $passedAppVersion = $request->header('app-version');

        if (version_compare($passedAppVersion, config('mobile.supported_version'), '<')) {

            return response()->json(['error' => 'Unsupported version'], Response::HTTP_VERSION_NOT_SUPPORTED);
        }

        return $next($request);

    }
}
