<?php

namespace App\Services;

use App\Repositories\CarsRepository;
use App\Repositories\ClientsRepository;

class StatsService
{
    public function __construct(
        public CarsRepository    $carsRepository,
        public ClientsRepository $clientsRepository,
    ) {}

    public function getParkedCars(): int
    {
        return $this->carsRepository->countRecords(isParked: true);
    }

    public function getAllCars(): int
    {
        return $this->carsRepository->countRecords();
    }

    public function getAllClients(): int
    {
        return $this->clientsRepository->countRecords();
    }
}
