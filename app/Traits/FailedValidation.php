<?php

namespace App\Traits;

use App\Helpers\ResponseFormatter;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

trait FailedValidation
{
    /**
     * Useful for auto create id with uuid when first call create function.
     *
     * @return void
     */

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ResponseFormatter::error($validator->errors()->first(), 400));
    }
}
