<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUserNotificationSettingsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'send_to_email' => 'boolean',
            'send_to_app' => 'boolean',
            'at_time' => 'string',
            'notify_day' => 'int',
        ];
    }
}
