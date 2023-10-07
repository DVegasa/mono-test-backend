<?php

namespace App\Http\Presenters;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Response;

class BasePresenter
{
    public const STATUS_OK = 'ok';
    public const STATUS_ERROR = 'error';

    public function success(mixed $data = []): Response
    {
        if (is_array($data) && empty($data)) {
            $data = new \stdClass();
        }

        $response = response([
            'status' => self::STATUS_OK,
            'data' => $data,
        ]);

        return $response->setStatusCode(200);
    }


    public function paginated(LengthAwarePaginator $data, ?string $resourceNamespace = null): Response
    {
        $items = $data->items();
        if ($resourceNamespace) {
            $items = $resourceNamespace::collection($items);
        }

        return response([
            'status' => self::STATUS_OK,
            'data' => [
                'pagination' => [
                    'perPage' => $data->perPage(),
                    'currentPage' => $data->currentPage(),
                    'lastPage' => $data->lastPage(),
                    'total' => $data->total(),
                ],
                'items' => $items,
            ],
        ])->setStatusCode(200);
    }

    public function error(
        mixed   $data,
        int     $status,
        string  $errorCode = 'unspecified',
        ?string $message = 'Ошибка сервера',
    ): Response
    {
        return response([
            'status' => self::STATUS_ERROR,
            'data' => [
                'code' => $errorCode,
                'message' => $message,
                'content' => $data,
            ],
        ])->setStatusCode($status);
    }

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }
}
