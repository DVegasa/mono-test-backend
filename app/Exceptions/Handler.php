<?php

namespace App\Exceptions;

use App\Http\Presenters\BasePresenter;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        // Публичная ошибка приложения
        $this->renderable(static fn(PublicException $e) => (new BasePresenter())->error(
            data: $e->getData(),
            status: $e->getHttpCode(),
            errorCode: $e->getErrorCode(),
            message: $e->publicMessage(),
        ));

        // Ошибка валидации Laravel Request
        $this->renderable(static fn(ValidationException $e) => (new BasePresenter())->error(
            data: $e->errors(),
            status: 400,
            errorCode: 'validationError',
            message: $e->getMessage(),
        ));

        // Все остальные ошибки
        $this->renderable(static fn(\Exception $e) => (new BasePresenter())->error(
            data: null,
            status: 500,
            errorCode: 'serverError',
            message: $e->getMessage(),
        ));
    }
}
