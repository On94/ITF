<?php

namespace App\Http\Controllers\API\Auth;

use App\Facades\UserServiceFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\SignInRequest;
use App\Http\Resources\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @param SignInRequest $request
     * @return ApiResponse|JsonResponse
     */
    public function signIn(SignInRequest $request): ApiResponse|JsonResponse
    {
        $credentials = $request->only(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return ApiResponse::make([
                'status' => 'error',
                'message' => 'Unauthorized',
                'data' => 'Invalid credentials'
            ])->response()->setStatusCode(401);
        }
        return ApiResponse::make([
            'data' => ['name' => Auth::user()->name,
                'user_id' => Auth::user()->id,
                'email' => Auth::user()->email,
                'access_token' => UserServiceFacade::createAccessToken(Auth::user()),
                'token_type' => 'bearer',
                'expires_in' => 3600,
            ]
        ]);
    }

}
