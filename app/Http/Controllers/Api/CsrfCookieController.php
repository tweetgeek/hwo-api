<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CsrfCookieController extends ApiController
{

    /**
     * Return an empty response simply to trigger the storage of the CSRF cookie in the browser.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        if ($request->expectsJson()) {
            return new JsonResponse(['token' => csrf_token()], 200);
        }

        return new Response(csrf_token(), 200);
    }

}
