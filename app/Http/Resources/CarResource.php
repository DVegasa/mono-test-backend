<?php

namespace App\Http\Resources;

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
            'is_parked' => (bool)$this?->is_parked,
            'owner_id' => $this?->owner_id,
        ];
    }
}
