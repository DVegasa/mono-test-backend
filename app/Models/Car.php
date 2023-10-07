<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    use HasTimestamps;

    protected $guarded = [];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'owner_id');
    }
}
