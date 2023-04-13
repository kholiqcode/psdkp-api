<?php

namespace App\Http\Requests\Auth;

use App\Traits\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class VerifyOtpRequest extends FormRequest
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
            'otp' => 'required|numeric|min:6',
        ];
    }
}
