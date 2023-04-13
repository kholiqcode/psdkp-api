<?php

namespace App\Services;

use App\Jobs\SendOtpJob;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

            if (!$token) {
                throw new \Exception('Login Failed');
            }

            $user = JWTAuth::user();

            if (!$user?->email_verified_at) {
                throw new \Exception('Please verify your email first');
            }

            if (!$user?->is_verified) {
                throw new \Exception('Admin has not verified your account yet');
            }

            if ($user?->token && $user?->token !== $token) {
                JWTAuth::setToken($user->token)->invalidate();
            }

            $user->token = $token;
            $user->save();

            return compact(['token', 'user']);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function register($request)
    {
        try {
            $otp = rand(100000, 999999);
            $otpExpiredIn2Minute = now()->addMinutes(2)->format('Y-m-d H:i:s');

            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'otp' => $otp,
                'otp_expired_at' => $otpExpiredIn2Minute
            ]);

            $user->assignRole('user');

            if (!$user) {
                DB::rollBack();
                throw new \Exception('Register Failed');
            }

            // event(new UserActivationEmail($user)); // use other service for sending email

            SendOtpJob::dispatch($user)->afterCommit();


            $token = JWTAuth::fromUser($user);

            DB::commit();

            return compact(['token', 'user']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
