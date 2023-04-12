<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Services\VerificationService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function verifyUser(Request $request)
    {
        try {
            $verificationService = new VerificationService();
            $payload = $verificationService->verifyUser($request);

            return ResponseFormatter::success($payload, 'User Verified Successfully');
        } catch (\Exception $e) {
            ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}
