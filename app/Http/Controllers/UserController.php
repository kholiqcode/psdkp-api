<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\User\EditUserRequest;
use App\Services\VerificationService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function verifyUser(Request $request)
    {
        try {
            $verificationService = new VerificationService();
            $payload = $verificationService->verifyUser($request);

            return ResponseFormatter::success($payload, 'User Verified Successfully');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }

    public function editUser(EditUserRequest $request)
    {
        try {
            $verificationService = new VerificationService();
            $payload = $verificationService->update($request->validated());

            return ResponseFormatter::success($payload, 'User Edited Successfully');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}
