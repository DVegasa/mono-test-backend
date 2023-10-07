<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasTimestamps;

    protected $guarded = [];

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'owner_id');
    }
}
