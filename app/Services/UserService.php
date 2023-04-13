<?php

namespace App\Services;

use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class UserService
{
    public function update($request)
    {
        try {
            $user = JWTAuth::user();
            $user->name = $request['name'];
            $user->save();

            return $user;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function delete($request)
    {
        try {
            $user = User::find($request['id']);

            if (!$user) {
                throw new \Exception('User Not Found');
            }

            $user->delete();

            return $user;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
