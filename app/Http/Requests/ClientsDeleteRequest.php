<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientsDeleteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'clientId' => ['required', 'numeric'],
        ];
    }
}
