<?php

namespace App\Http\Requests;

use App\DTOs\PaginatorDTO;
use Illuminate\Foundation\Http\FormRequest;

class ClientsGetListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            ...PaginatorDTO::validationRules(),
        ];
    }
}
