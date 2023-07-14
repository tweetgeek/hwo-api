<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\AuthorizeMobileDevice;
use App\Enums\UserRole;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\VerifyRequest;
use App\LoginRateLimiter;
use App\Models\User;
use DB;
use Exception;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends ApiController
{
    private LoginRateLimiter $limiter;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(LoginRateLimiter $limiter)
    {
        $this->limiter = $limiter;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * @throws Exception
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (!$token = auth()->attempt($request->only(['email', 'password']))) {
            $this->limiter->increment($request);
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        $device = $this->processDevice($request);
        $this->limiter->clear($request);

        event(new Login('api', auth()->user(), true));
        return $this->respondWithToken($token, $device?->id);
    }

    public function logout(): JsonResponse
    {
        event(new Logout('api', auth()->user()));
        auth()->logout(true);
        return $this->respondNoContent();
    }

    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function me(): JsonResponse
    {
        return $this->respondOk(auth()->user());
    }

    /**
     * @throws Exception
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $payload = $request->only([
            'name',
            'email',
            'password',
        ]);

        return DB::transaction(function () use ($payload, $request) {
            $user = User::create([
                'name' => $payload['name'],
                'email' => $payload['email'],
                'password' => Hash::make($payload['password']),
            ]);
            $user->assignRole(UserRole::USER->value);

            $token = auth()->login($user);
            $device = $this->processDevice($request);
            $this->limiter->clear($request);

            event(new Registered($user));
            event(new Login('api', auth()->user(), true));

            return $this->respondWithToken($token, $device?->id);
        });
    }


    public function verify(VerifyRequest $request): JsonResponse
    {
        $code = $request->get('code');

        $user = auth()->user();
        $user->markEmailAsVerified();
        $user->userVerificationCode()->where('code', $code)->delete();
        event(new Verified($user));

        return $this->respondNoContent();
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token, ?string $deviceId = null): JsonResponse
    {
        return $this->respondOk([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'device_id' => $deviceId,
            'user' => auth()->user(),
        ]);
    }

    /**
     * @throws Exception
     */
    private function processDevice(Request $request)
    {
        if ($request->hasHeader(config('mobile.app_version_header')) || $request->has(config('mobile.device_info_field'))) {
            return app(AuthorizeMobileDevice::class)->handle($request);
        }

        return null;
    }


}
