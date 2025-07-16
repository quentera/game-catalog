<?php

namespace App\Services\Auth;

use App\Repositories\Auth\UserRepository;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;

class AuthService
{
    protected UserRepository $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function register(array $data): array
    {
        $user = $this->users->create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = JWTAuth::fromUser($user);

        return [
            'message' => 'Registration successful',
            'user'    => $user,
            'token'   => $token
        ];
    }

    public function login(array $credentials): array
    {
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return [
                    'error'   => true,
                    'message' => 'Invalid credentials',
                    'code'    => 401
                ];
            }
        } catch (JWTException $e) {
            return [
                'error'   => true,
                'message' => 'Token generation failed',
                'code'    => 500
            ];
        }

        $timestamp = now()->timestamp;
        $signature = hash_hmac('sha256', $token . $timestamp, env('SIGNATURE_SECRET', 'quentara'));

        return [
            'message'   => 'Login successful',
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60,
            'signature'    => $signature,
            'timestamp'    => $timestamp
        ];
    }

    public function getPaginated(int $limit = 10)
    {
        return $this->users->paginate($limit);
    }

    public function refreshToken(): array
    {
        try {
            $newToken = JWTAuth::parseToken()->refresh();
        } catch (JWTException $e) {
            return [
                'error'   => true,
                'code'    => 401,
                'message' => 'Token refresh failed: ' . $e->getMessage()
            ];
        }

        return [
            'access_token' => $newToken,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60,
            'message'      => 'Token refreshed successfully'
        ];
    }

}
