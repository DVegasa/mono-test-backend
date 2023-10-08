<?php

namespace App\Http\Controllers;

use App\DTOs\PaginatorDTO;
use App\Exceptions\NotFoundException;
use App\Exceptions\UniqueViolationException;
use App\Http\Presenters\BasePresenter;
use App\Http\Requests\CarsCreateRequest;
use App\Http\Requests\CarsDeleteRequest;
use App\Http\Requests\CarsGetListRequest;
use App\Http\Requests\CarsGetRequest;
use App\Http\Requests\CarsUpdateRequest;
use App\Http\Resources\CarResource;
use App\Repositories\CarsRepository;
use App\Repositories\ClientsRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CarsController extends Controller
{

    public function __construct(
        public BasePresenter     $basePresenter,
        public CarsRepository    $carsRepo,
        public ClientsRepository $clientsRepo,
    )
    {
        parent::__construct($basePresenter);
    }


    /**
     * @throws NotFoundException
     */
    public function get(CarsGetRequest $request): Response
    {
        DB::beginTransaction();
        $res = $this->carsRepo->find(id: $request->input('carId'));
        if (!$res) throw new NotFoundException();

        DB::commit();
        return $this->basePresenter->success(new CarResource($res));
    }


    public function getList(CarsGetListRequest $request): Response
    {
        DB::beginTransaction();
        $res = $this->carsRepo->findMany(
            paginator: PaginatorDTO::fromRequest($request),
            ownerId: $request->input('ownerId'),
            q: $request->input('q'),
        );

        DB::commit();
        return $this->basePresenter->paginated($res, CarResource::class);
    }


    /**
     * @throws UniqueViolationException
     * @throws NotFoundException
     */
    public function create(CarsCreateRequest $request): Response
    {
        DB::beginTransaction();
        if ($this->carsRepo->find(plate: $request->input('plate'))) {
            throw new UniqueViolationException(['plate']);
        }
        if (!$this->clientsRepo->find(id: $request->input('ownerId'))) {
            throw new NotFoundException();
        }

        $id = $this->carsRepo->create([
            'brand' => $request->input('brand'),
            'model' => $request->input('model'),
            'color' => $request->input('color'),
            'plate' => $request->input('plate'),
            'is_parked' => $request->input('isParked'),
            'owner_id' => $request->input('ownerId'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $res = $this->carsRepo->find(id: $id);

        DB::commit();
        return $this->basePresenter->success(new CarResource($res));
    }


    /**
     * @throws UniqueViolationException
     * @throws NotFoundException
     */
    public function update(CarsUpdateRequest $request): Response
    {
        DB::beginTransaction();
        $id = $request->input('carId');

        if (!$this->carsRepo->find(id: $id)) throw new NotFoundException();
        if ($this->carsRepo->find(plate: $request->input('plate'))) throw new UniqueViolationException(['plate']);

        $this->carsRepo->update($id, [
            'brand' => $request->input('brand'),
            'model' => $request->input('model'),
            'color' => $request->input('color'),
            'plate' => $request->input('plate'),
            'is_parked' => $request->input('isParked'),
            'owner_id' => $request->input('ownerId'),
            'updated_at' => now(),
        ]);
        $res = $this->carsRepo->find(id: $id);

        DB::commit();
        return $this->basePresenter->success(new CarResource($res));
    }


    /**
     * @throws NotFoundException
     */
    public function delete(CarsDeleteRequest $request): Response
    {
        DB::beginTransaction();
        $res = $this->carsRepo->delete($request->input('carId'));
        if (!$res) throw new NotFoundException();

        DB::commit();
        return $this->basePresenter->success();
    }


    public function switchParking(Request $request): Response
    {
        return response(['status' => 'wip']);
    }
}
