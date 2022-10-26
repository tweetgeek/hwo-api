<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserOnboardingPutRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required'],
            'name' => ['required', 'string'],
            'value' => ['required', 'array'],
        ];
    }
}
