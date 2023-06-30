<?php

namespace App\Http\Requests;

use App\Enums\DeviceType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class PostUserDeviceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'type' => ['required', new Enum(DeviceType::class)],
            'isDevice' => ['required_if:type,mobile'],
            'brand' => ['required_if:type,mobile'],
            'manufacturer' => ['required_if:type,mobile'],
            'modelName' => ['required_if:type,mobile'],
            'modelId' => ['required_if:type,mobile|nullable'],
            'osName' => ['required_if:type,mobile'],
            'osVersion' => ['required_if:type,mobile'],
            'osBuildId' => ['required_if:type,mobile'],
            'deviceName' => ['required_if:type,mobile'],
            'pushToken' => ['nullable', 'string'],
        ];
    }
}
