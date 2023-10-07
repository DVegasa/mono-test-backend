<?php

namespace App\Http\Resources;

use App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => (int)$this?->id,
            'name' => $this?->name,
            'sex' => (bool)$this?->sex,
            'phone' => $this?->phone,
            'address' => $this?->address,
            'created_at' => Helpers::apiDateFormat($this?->created_at),
            'updated_at' => Helpers::apiDateFormat($this?->updated_at),
        ];
    }
}
