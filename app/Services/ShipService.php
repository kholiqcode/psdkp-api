<?php

namespace App\Services;

use App\Models\Ship;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class ShipService
{
    public function register($request)
    {
        try {
            $userId = JWTAuth::user()->id;

            $photoFile = request()->file('photo_file');
            $photoPath = $this->uploadFile($photoFile, 'ship/photos');

            $permissionDocumentFile = request()->file('permission_document_file');
            $permissionDocumentPath = $this->uploadFile($permissionDocumentFile, 'ship/documents');

            $shipData = [
                'code' => $request['code'],
                'name' => $request['name'],
                'owner_name' => $request['owner_name'],
                'owner_street_address' => $request['owner_street_address'],
                'ship_size' => $request['ship_size'],
                'photo_path' => $photoPath,
                'total_crew' => $request['total_crew'],
                'permission_number' => $request['permission_number'],
                'permission_document_path' => $permissionDocumentPath,
                'user_id' => $userId,
            ];

            $ship = Ship::create($shipData);

            return compact(['ship']);
        } catch (\Exception $e) {
            if (isset($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }

            if (isset($permissionDocumentPath)) {
                Storage::disk('public')->delete($permissionDocumentPath);
            }

            throw $e;
        }
    }

    public function verify($request)
    {
        try {
            $ship = Ship::find($request['id']);

            if (!$ship) {
                throw new \Exception('Ship not found');
            }

            if ($ship->is_verified) {
                throw new \Exception('Ship already verified');
            }

            $ship->is_verified = true;
            $ship->save();

            return compact(['ship']);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function uploadFile($file, $path)
    {
        $fileName = strtolower($file->getFilename() . "_" . date('d-m-Y') . "_" . Str::random(5) . '.' . $file->extension());
        $file->storeAs($path, $fileName, 'public');

        $filePath = $path . DIRECTORY_SEPARATOR . $fileName;

        return $filePath;
    }
}
