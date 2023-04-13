<?php

namespace App\Http\Requests\Ship;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class DeleteShipRequest extends FormRequest
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
            'id' => 'required|exists:ships,id',
        ];
    }
}
