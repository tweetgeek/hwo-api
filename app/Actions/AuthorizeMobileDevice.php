<?php

namespace App\Actions;

use App\Models\UserDevice;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\LoginRateLimiter;

class AuthorizeMobileDevice
{
    /**
     * The login rate limiter instance.
     *
     * @var \Laravel\Fortify\LoginRateLimiter
     */
    protected $limiter;

    /**
     * Create a new class instance.
     *
     * @param \Laravel\Fortify\LoginRateLimiter $limiter
     * @return void
     */
    public function __construct(LoginRateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    public function handle(Request $request, Closure $next)
    {
        $isMobileApp = $request->hasHeader(config('mobile.app_version_header'));
        if (!$isMobileApp) {
            return $next($request);
        }

        if (!$deviceId = $request->header(config('mobile.device_info_id_header'))) {
            $this->limiter->increment($request);
            $request->session()->invalidate();

            throw ValidationException::withMessages([
                'device' => ['Invalid device!'],
            ]);
        }

        if (!$request->has(config('mobile.device_info_field'))) {
            $this->limiter->increment($request);
            $request->session()->invalidate();

            throw ValidationException::withMessages([
                'device' => ['Invalid device!'],
            ]);
        }

        $device = UserDevice::find($deviceId);
        if ($device && $device->user_id !== $request->user()->id) {
            $this->limiter->increment($request);
            $request->session()->invalidate();
            throw ValidationException::withMessages([
                'device_id' => ['Device conflict!'],
            ]);
        }

        $device = $request->user()->authorizeDevice([...$request->get(config('mobile.device_info_field')), 'id' => $deviceId, 'type' => 'mobile']);

        $request->session()->put(config('mobile.device_info_id_header'), $device->id);

        $this->limiter->clear($request);

        return $next($request);
    }
}
