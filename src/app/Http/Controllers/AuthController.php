<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Services\Auth\AuthService;
use App\Traits\ApiResponse;

class AuthController extends Controller
{
    use ApiResponse;

    protected AuthService $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function register(RegisterRequest $request)
    {
        $result = $this->auth->register($request->validated());

        return $this->success([
            'user'  => new UserResource($result['user']),
            'token' => $result['token']
        ], $result['message'], 201);    
    }

    public function login(LoginRequest $request)
    {
        $result = $this->auth->login($request->validated());

        if (isset($result['error']) && $result['error'] === true) {
           return $this->error($result['message'], $result['code']);
        }

        return $this->success([
            'access_token' => $result['access_token'],
            'token_type'   => $result['token_type'],
            'expires_in'   => $result['expires_in'],
            'signature'    => $result['signature'],
            'timestamp'    => $result['timestamp'],
        ], $result['message']);
    }

    public function me()
    {
        return $this->success([
            'user' => new UserResource(auth()->user())
        ]);
    }

    public function refresh()
    {
        try {
            $result = $this->auth->refreshToken();

            if (isset($result['error']) && $result['error'] === true) {
                return $this->error($result['message'], $result['code']);
            }

            return $this->success([
                'access_token' => $result['access_token'],
                'token_type'   => $result['token_type'],
                'expires_in'   => $result['expires_in'],
            ], $result['message']);
        } catch (\Exception $e) {
            return $this->error('Could not refresh token', 500, [$e->getMessage()]);
        }
    }

    public function logout()
    {
        auth()->logout(); 
        return $this->success([], 'Logged out successfully');
    }

}
