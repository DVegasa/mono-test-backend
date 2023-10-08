<?php

namespace App\Http\Requests;

use App\DTOs\PaginatorDTO;
use Illuminate\Foundation\Http\FormRequest;

class CarsGetListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            ...PaginatorDTO::validationRules(),
            'ownerId' => ['nullable', 'numeric', 'integer'],
            'q' => ['nullable', 'string'],
        ];
    }
}
