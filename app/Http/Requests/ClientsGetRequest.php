<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientsGetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'clientId' => ['required', 'numeric', 'integer'],
        ];
    }
}
