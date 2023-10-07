<?php

namespace App\Exceptions;

use App\Helpers;

class DevException extends PublicException
{
    public function getErrorCode(): string
    {
        return 'dev';
    }

    public function getHttpCode(): int
    {
        return 451;
    }

    public function getData(): mixed
    {
        return [
            'time' => Helpers::apiDateFormat(now()),
        ];
    }

    public function publicMessage(): ?string
    {
        return 'Тестовая ошибка для проверки бэкенда';
    }
}
