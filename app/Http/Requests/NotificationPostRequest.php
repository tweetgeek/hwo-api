<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationPostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ids' => ['required', 'array'],
        ];
    }
}
