<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Services\{UserService, VerificationService};
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
            $userService = new UserService();
            $payload = $userService->update($request->validated());

            return ResponseFormatter::success($payload, 'User Edited Successfully');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }

    public function deleteUser(DeleteUserRequest $request)
    {
        try {
            $userService = new UserService();
            $payload = $userService->delete($request->validated());

            return ResponseFormatter::success($payload, 'User Deleted Successfully', 201);
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}
