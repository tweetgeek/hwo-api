<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends ApiController
{
//reset-password
//confirm-password
    public function get(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }
}
