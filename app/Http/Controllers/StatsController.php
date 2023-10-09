<?php

namespace App\Http\Controllers;

use App\Http\Presenters\BasePresenter;
use App\Http\Requests\StatsAllRequest;
use App\Services\StatsService;
use Illuminate\Http\Response;

class StatsController extends Controller
{
    public function __construct(
        BasePresenter       $basePresenter,
        public StatsService $statsService,
    )
    {
        parent::__construct($basePresenter);
    }


    public function all(StatsAllRequest $request): Response
    {
        return $this->basePresenter->success([
            'cars' => [
                'all' => $this->statsService->getAllCars(),
                'parked' => $this->statsService->getParkedCars(),
            ],
            'clients' => [
                'all' => $this->statsService->getAllClients(),
            ]
        ]);
    }
}
