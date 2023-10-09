<?php

namespace App\Http\Resources;

use App\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    public function toArray(mixed $request)
    {
        return [
            'id' => (int)$this?->id,
            'name' => $this?->name,
            'sex' => (bool)$this?->sex,
            'phone' => $this?->phone,
            'address' => $this?->address,
            'createdAt' => Helpers::apiDateFormat($this?->created_at),
            'updatedAt' => Helpers::apiDateFormat($this?->updated_at),
        ];
    }
}
