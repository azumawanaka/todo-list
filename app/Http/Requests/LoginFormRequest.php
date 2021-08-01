<?php

namespace App\Http\Requests;

class LoginFormRequest extends AbstractFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [
                'email',
                'required',
                'regex:/(.+)@(.+)\.(.+)/i',
            ],
            'password' => [
                'filled',
            ],
        ];
    }
}
