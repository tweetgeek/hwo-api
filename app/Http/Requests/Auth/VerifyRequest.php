<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use App\Models\UserVerificationCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Exists;

class VerifyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', (new Exists(User::class, 'email'))->where('id', Auth::user()->id)],
            'code' => ['required', 'string', 'min:6', (new Exists(UserVerificationCode::class, 'code'))->where('user_id', Auth::user()->id)],
        ];
    }
}
