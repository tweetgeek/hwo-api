<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PostUserDeviceRequest;
use Illuminate\Http\JsonResponse;

class UserDeviceController extends ApiController
{
    public function post(PostUserDeviceRequest $request): JsonResponse
    {
        return response()->json($request->user()->authorizeDevice($request->validated()));
    }
}
