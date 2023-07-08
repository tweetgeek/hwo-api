<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerifyController extends ApiController
{
    //verify

    public function verify(Request $request): JsonResponse
    {
//        $credentials = request(['email', 'password']);

//        if (!$token = auth()->attempt($credentials)) {
//            return response()->json(['error' => 'Unauthorized'], 401);
//        }
//
//        return $this->respondWithToken($token);
    }

}
