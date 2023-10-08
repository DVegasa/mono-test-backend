<?php

namespace App\Http\Requests;

use App\Rules\RussianCivilPlate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CarsUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'carId' => ['required', 'numeric', 'integer'],
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:255'],
            'plate' => ['required', 'string', 'max:50', new RussianCivilPlate()],
            'isParked' => ['required', 'boolean'],
            'ownerId' => ['required', 'numeric', 'integer'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'plate' => Str::upper($this->plate),
        ]);
    }
}
