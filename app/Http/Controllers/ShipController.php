<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\Ship\{DeleteShipRequest, EditShipRequest, RegisterShipRequest, VerifyShipRequest};
use App\Services\ShipService;

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

    public function deleteShip(DeleteShipRequest $request)
    {
        try {
            $shipService = new ShipService();

            $ship = $shipService->delete($request->validated());

            return ResponseFormatter::success($ship, 'Ship deleted successfully', 204);
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage());
        }
    }

    public function editShip(EditShipRequest $request)
    {
        try {
            $shipService = new ShipService();
            $ship = $shipService->updateShip($request->validated());

            return ResponseFormatter::success($ship, 'Ship edited successfully');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage());
        }
    }

    public function getShip()
    {
        try {
            $shipService = new ShipService();
            $ship = $shipService->getShip();

            return ResponseFormatter::success($ship, 'Ship retrieved successfully');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage());
        }
    }
}
