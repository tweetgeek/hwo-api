<?php

namespace App\Http\Requests\Auth;

use App\Enums\DeviceType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'device' => ['required'],
            'device.id' => ['required', 'uuid'],
            'device.type' => ['required', new Enum(DeviceType::class)],
            'device.brand' => ['required_if:device.type,mobile'],
            'device.manufacturer' => ['required_if:device.type,mobile'],
            'device.modelName' => ['required_if:device.type,mobile'],
            'device.modelId' => ['required_if:device.type,mobile|nullable'],
            'device.osName' => ['required_if:device.type,mobile'],
            'device.osVersion' => ['required_if:device.type,mobile'],
            'device.osBuildId' => ['required_if:device.type,mobile'],
            'device.deviceName' => ['required_if:device.type,mobile'],
            'device.pushToken' => ['nullable', 'string'],
        ];
    }
}
