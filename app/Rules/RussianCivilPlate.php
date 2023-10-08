<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RussianCivilPlate implements ValidationRule
{

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $russianCivilPlateRegex = '/^[ABEKMHOPCTYX]\d{3}[ABEKMHOPCTYX][ABEKMHOPCTYX]\d{2,3}$/';
        if (!preg_match($russianCivilPlateRegex, '' . $value)) {
            $fail(':attribute не подходит под рег.знак (пример подходящего: А123АА134)');
        }
    }
}
