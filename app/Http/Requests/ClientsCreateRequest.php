<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientsCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'sex' => ['required', 'boolean'],
            'phone' => ['required', 'starts_with:+', 'max:15'],
            'address' => ['nullable', 'string'],
        ];
    }
}
