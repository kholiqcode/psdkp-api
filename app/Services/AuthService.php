<?php

namespace App\Services;

use App\Events\UserActivationEmail;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function login($request)
    {
        try {
            $token = JWTAuth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ]);

            if (!auth()->user()->email_verified_at) {
                throw new \Exception('Please verify your email first');
            }

            if (!auth()->user()->is_verified) {
                throw new \Exception('Admin has not verified your account yet');
            }

            if (!$token) {
                throw new \Exception('Login Failed');
            }

            $payload = ['token' => $token, 'user' => auth()->user()];
            return $payload;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function register($request)
    {
        try {
            $otp = rand(100000, 999999);
            $otpExpiredIn2Minute = now()->addMinutes(2)->format('Y-m-d H:i:s');

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'otp' => $otp,
                'otp_expired_at' => $otpExpiredIn2Minute
            ]);

            if ($user) {
                event(new UserActivationEmail($user));

                $token = JWTAuth::fromUser($user);

                $payload = ['token' => $token, 'user' => $user];

                return $payload;
            }

            throw new \Exception('Register Failed');
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
