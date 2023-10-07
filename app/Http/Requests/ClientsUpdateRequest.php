<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientsUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'clientId' => ['required', 'numeric'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'sex' => ['required', 'boolean'],
            'phone' => ['required', 'starts_with:+', 'max:15'],
            'address' => ['nullable', 'string'],
        ];
    }
}
