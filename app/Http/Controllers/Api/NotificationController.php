<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends ApiController
{
    public function get(Request $request): JsonResponse
    {
        return response()->json($request->user()->notifications);
    }
}
