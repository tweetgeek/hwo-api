<?php

namespace App\Http\Requests\Auth;

use App\Enums\DeviceType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Enum;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
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
            'device.pushToken' => ['string'],
        ];
    }
}
