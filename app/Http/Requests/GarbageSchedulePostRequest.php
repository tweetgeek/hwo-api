<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GarbageSchedulePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3'],
            'isPublic' => ['required', 'boolean'],
            'city' => ['required', 'string'],
            'placeId' => ['required', 'string'],
            'collectionsDates' => ['required', 'array'],
            'collectionsDates.*.*' => ['required', 'string'],
        ];
    }
}
