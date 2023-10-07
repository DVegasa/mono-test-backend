<?php

namespace App\DTOs;


use Illuminate\Http\Request;

class PaginatorDTO
{
    public function __construct(
        public readonly int $currentPage,
        public readonly int $perPage,
    ) {}

    public static function fromRequest(Request $request): PaginatorDTO
    {
        return new PaginatorDTO(
            currentPage: $request->input('currentPage'),
            perPage: $request->input('perPage'),
        );
    }

    public static function validationRules(): array
    {
        return [
            'currentPage' => ['required', 'numeric'],
            'perPage' => ['required', 'numeric'],
        ];
    }

}
