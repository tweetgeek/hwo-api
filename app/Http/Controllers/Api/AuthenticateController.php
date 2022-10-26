<?php

namespace App\Http\Controllers\Api;

use App\Enums\DeviceType;
use App\Http\Controllers\Api\Concerns\GeneratesApiResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\VerifyRequest;
use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthenticateController extends Controller
{
    use GeneratesApiResponses;

    public function login(LoginRequest $request): JsonResponse
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

        event(new Login('jwt', $user, true));

        return $this->respondOk(['token' => $token, 'user' => $user, 'device' => $userDevice]);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verified_at' => null,
        ]);

        event(new Registered($user));

        $token = $user->createToken($this->prepareTokenName($request))->plainTextToken;

        /** @var UserDevice $userDevice */
        $userDevice = $user->authorizeDevice($request->validated('device'));

        event(new Login('jwt', $user, true));

        return $this->respondOk(['token' => $token, 'user' => $user, 'device' => $userDevice]);
    }

    public function verify(VerifyRequest $request): JsonResponse
    {
        if (!$request->user()->isVerified()) {
            $request->user()->markAsVerified();
            $request->user()->userVerificationCode()->where('code', $request->input('code'))->delete();

            event(new Verified($request->user()));
        }

        return $this->respondOk();
    }


    public function forgotPassword(Request $request): JsonResponse
    {
        return $this->respondOk();
    }

    public function resetPassword(Request $request): JsonResponse
    {
        return $this->respondOk();
    }

    public function destroy(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();

        event(new Logout('jwt', $request->user()));

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

    private function prepareTokenName(LoginRequest|RegisterRequest $request): string
    {
        $device = $request->validated('device');
        if ($device['type'] === DeviceType::WEB->value) {
            return sprintf('%s.%s', 'web_browser', $request->ip());
        }

        return sprintf('%s.%s-%s-%s', 'mobile', $device['deviceName'], $device['manufacturer'], $device['modelName']);
    }
}
