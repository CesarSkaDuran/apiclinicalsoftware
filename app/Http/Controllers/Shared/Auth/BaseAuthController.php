<?php

namespace App\Http\Controllers\Shared\Auth;

use App\Http\Controllers\Controller;

abstract class BaseAuthController extends Controller
{
    function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    function respondWithTokenAndUser($token, $userData)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => $userData
        ]);
    }
}
