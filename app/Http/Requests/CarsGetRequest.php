<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarsGetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'carId' => ['required', 'numeric', 'integer'],
        ];
    }
}
