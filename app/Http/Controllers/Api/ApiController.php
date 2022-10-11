<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController // implements ApiControllerContract
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

//    public function index(): JsonResponse
//    {
//        return response()->json();
//    }
//
//    public function filter(mixed $request): JsonResponse
//    {
//        return response()->json();
//    }
//
//    public function store(mixed $request): JsonResponse
//    {
//        return response()->json();
//    }
//
//    public function show($id): JsonResponse
//    {
//        return response()->json();
//    }
//
//    public function update($request, $id): Response
//    {
//        return response()->noContent();
//    }
//
//    public function destroy($id): Response
//    {
//        return response()->noContent();
//    }
}
