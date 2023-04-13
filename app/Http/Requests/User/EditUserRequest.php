<?php

namespace App\Http\Requests\User;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'name' => 'required|string',
        ];
    }
}
