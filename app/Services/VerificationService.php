<?php

namespace App\Services;

use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class VerificationService
{
    public function verifyOtp($request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                throw new \Exception('User Not Found');
            }

            if ($user->otp != $request->otp) {
                throw new \Exception('OTP Not Match');
            }

            if ($user->otp_expired_at < now()) {
                throw new \Exception('OTP Expired');
            }

            $user->update([
                'otp' => null,
                'otp_expired_at' => null,
                'email_verified_at' => now(),
            ]);

            $token = JWTAuth::fromUser($user);

            $payload = ['token' => $token, 'user' => $user];


            return $payload;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function verifyUser($request)
    {
        try {
            $user = User::find($request->id);
            $user->is_verified = true;
            $user->save();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
