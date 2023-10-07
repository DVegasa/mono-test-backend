<?php

namespace App;

use Carbon\Carbon;
use DateTimeInterface;

class Helpers
{
    static function apiDateFormat(?DateTimeInterface $dateTime): ?string
    {
        if (!$dateTime) return null;
        return Carbon::make($dateTime)->toISOString();
    }
}

