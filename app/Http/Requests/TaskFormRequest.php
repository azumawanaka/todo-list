<?php

namespace App\Http\Requests;

class TaskFormRequest extends AbstractFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'summary' => [
                'required',
                'max:255',
            ],
            'description' => [
                'required',
                'max:255',
            ],
            'due_date' => [
                'required',
            ],
        ];
    }
}
