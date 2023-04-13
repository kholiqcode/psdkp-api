<?php

namespace App\Http\Requests\Ship;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class RegisterShipRequest extends FormRequest
{
    use FailedValidation;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string',
            'name' => 'required|string',
            'owner_name' => 'required|string',
            'owner_street_address' => 'required|string',
            'ship_size' => 'required|numeric',
            'photo_file' => 'required|file|mimes:jpg,jpeg,png,pdf',
            'total_crew' => 'required|numeric',
            'permission_number' => 'required|string',
            'permission_document_file' => "required|file|mimes:jpg,jpeg,png,pdf",
        ];
    }
}
