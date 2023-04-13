<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\Ship\RegisterShipRequest;
use App\Http\Requests\Ship\VerifyShipRequest;
use App\Services\ShipService;
use Illuminate\Http\Request;

class ShipController extends Controller
{
    public function registerShip(RegisterShipRequest $request)
    {
        try {
            $shipService = new ShipService();
            $ship = $shipService->register($request->validated());

            return ResponseFormatter::success($ship, 'Ship registered successfully', 201);
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage());
        }
    }

    public function verifyShip(VerifyShipRequest $request)
    {
        try {
            $shipService = new ShipService();
            $ship = $shipService->verify($request->validated());

            return ResponseFormatter::success($ship, 'Ship verified successfully', 204);
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage());
        }
    }
}
