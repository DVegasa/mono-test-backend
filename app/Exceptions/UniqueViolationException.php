<?php

namespace App\Exceptions;

use Throwable;

class UniqueViolationException extends PublicException
{
    public function __construct(
        public array $fields,

        string       $message = "",
        int          $code = 0,
        ?Throwable   $previous = null,
    )
    {
        parent::__construct($message, $code, $previous);
    }

    public function getErrorCode(): string
    {
        return 'uniqueViolation';
    }

    public function getHttpCode(): int
    {
        return 400;
    }

    public function getData(): mixed
    {
        return $this->fields;
    }

    public function publicMessage(): ?string
    {
        return 'Некоторые поля уже существуют в БД и новая запись не может быть создана';
    }
}
