<?php

namespace App\Http\Resources;

use App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => (int)$this?->id,
            'brand' => $this?->brand,
            'model' => $this?->model,
            'color' => $this?->color,
            'plate' => $this?->plate,
            'isParked' => (bool)$this?->is_parked,
            'ownerId' => $this?->owner_id,
            'createdAt' => Helpers::apiDateFormat($this?->created_at),
            'updatedAt' => Helpers::apiDateFormat($this?->updated_at),
        ];
    }
}
