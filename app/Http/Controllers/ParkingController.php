<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Presenters\BasePresenter;
use App\Http\Requests\ParkingSwitchParkingRequest;
use App\Http\Resources\CarResource;
use App\Repositories\CarsRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ParkingController extends Controller
{
    public function __construct(
        public BasePresenter  $basePresenter,
        public CarsRepository $carsRepo,
    )
    {
        parent::__construct($basePresenter);
    }

    /**
     * @throws NotFoundException
     */
    public function switchParking(ParkingSwitchParkingRequest $request): Response
    {
        DB::beginTransaction();
        $id = $request->input('carId');
        if (!$this->carsRepo->find(id: $id)) {
            throw new NotFoundException();
        }
        $this->carsRepo->switchParking($id);
        $res = $this->carsRepo->find(id: $id);

        DB::commit();
        return $this->basePresenter->success(new CarResource($res));
    }
}
