<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class InfoController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'apiVersion' => '0.0.0',
            'maintenance' => false,
            'unsupported' => false,
            'user' => \Auth::user()
        ]);
    }
}
