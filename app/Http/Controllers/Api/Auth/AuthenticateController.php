<?php

namespace App\Http\Controllers\Api\Auth;

use App\Enums\DeviceType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthenticateController extends Controller
{
    public function store(LoginRequest $request): JsonResponse
    {
        $this->ensureIsNotRateLimited($request);

        $user = User::where('email', $request->validated('email'))->first();
        if (!$user || !Hash::check($request->validated('password'), $user->password)) {
            RateLimiter::hit($this->throttleKey($request));

            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        RateLimiter::clear($this->throttleKey($request));
        $token = $user->createToken($this->prepareTokenName($request))->plainTextToken;

        /** @var UserDevice $userDevice */
        $userDevice = $user->authorizeDevice($request->validated('device'));

        return response()->json(['token' => $token, 'refresh_token' => '', 'user' => $user, 'device' => $userDevice]);
    }

    public function destroy(): Response
    {
        /** @var User $user */
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return response()->noContent();
    }

    private function ensureIsNotRateLimited(LoginRequest $request): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        event(new Lockout($request));

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    private function throttleKey(LoginRequest $request): string
    {
        return Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip());
    }

    private function prepareTokenName(LoginRequest $request): string
    {
        $device = $request->validated('device');
        if ($device['type'] === DeviceType::WEB->value) {
            return sprintf('%s.%s', 'web_browser', $request->ip());
        }

        return sprintf('%s.%s-%s-%s', 'mobile', $device['deviceName'], $device['manufacturer'], $device['modelName']);
    }
}
