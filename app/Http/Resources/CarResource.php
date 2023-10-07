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
            'is_parked' => (bool)$this?->is_parked,
            'owner_id' => $this?->owner_id,
            'created_at' => Helpers::apiDateFormat($this?->created_at),
            'updated_at' => Helpers::apiDateFormat($this?->updated_at),
        ];
    }
}
