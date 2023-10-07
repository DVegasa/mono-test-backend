<?php

namespace App\Exceptions;

use Exception;

class PublicException extends Exception
{
    public function getErrorCode(): string
    {
        return 'unspecified';
    }

    public function getHttpCode(): int
    {
        return 400;
    }

    public function getData(): mixed
    {
        return null;
    }

    public function publicMessage(): ?string
    {
        return null;
    }
}
