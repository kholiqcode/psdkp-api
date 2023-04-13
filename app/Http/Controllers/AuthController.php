<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\Auth\{LoginRequest, RegisterRequest, VerifyOtpRequest};
use App\Services\{AuthService, VerificationService};

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $authService = new AuthService();
            $payload = $authService->login($request);

            return ResponseFormatter::success($payload, 'Login Successfully');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            $authService = new AuthService();
            $payload = $authService->register($request);

            return ResponseFormatter::success($payload, 'Register Successfully, Please check your email to verify your account', 201);
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }

    public function verifyOtp(VerifyOtpRequest $request)
    {
        try {
            $verificationService = new VerificationService($request);
            $payload = $verificationService->verifyOtp($request);

            return ResponseFormatter::success($payload, 'Verify Successfully');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}
