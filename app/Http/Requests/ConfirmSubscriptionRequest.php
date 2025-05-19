<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ConfirmSubscriptionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'token' => 'required|string|size:32',
        ];
    }

    public function validationData(): array
    {
        return [
            'token' => $this->route('token'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => 'Invalid token',
        ], 400));
    }
}
