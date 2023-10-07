<?php

namespace App;

use Carbon\Carbon;
use DateTimeInterface;

class Helpers
{
    static function apiDateFormat(string|DateTimeInterface $dateTime): ?string
    {
        if (is_string($dateTime)) $dateTime = Carbon::make($dateTime);
        if (!$dateTime) return null;
        return Carbon::make($dateTime)->toISOString();
    }
}

