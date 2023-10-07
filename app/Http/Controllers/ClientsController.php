<?php

namespace App\Http\Controllers;

use App\DTOs\PaginatorDTO;
use App\Exceptions\NotFoundException;
use App\Exceptions\UniqueViolationException;
use App\Http\Presenters\BasePresenter;
use App\Http\Requests\ClientsCreateRequest;
use App\Http\Requests\ClientsDeleteRequest;
use App\Http\Requests\ClientsGetListRequest;
use App\Http\Requests\ClientsGetRequest;
use App\Http\Requests\ClientsUpdateRequest;
use App\Http\Resources\ClientResource;
use App\Repositories\ClientsRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ClientsController extends Controller
{
    public function __construct(
        public BasePresenter     $basePresenter,
        public ClientsRepository $clientsRepo,
    )
    {
        parent::__construct($basePresenter);
    }


    /**
     * @throws NotFoundException
     */
    public function get(ClientsGetRequest $request): Response
    {
        DB::beginTransaction();
        $res = $this->clientsRepo->find(id: $request->input('clientId'));
        if (!$res) throw new NotFoundException();

        DB::commit();
        return $this->basePresenter->success(new ClientResource($res));
    }


    public function getList(ClientsGetListRequest $request): Response
    {
        DB::beginTransaction();
        $res = $this->clientsRepo->findMany(
            paginator: PaginatorDTO::fromRequest($request),
            q: $request->input('q'),
        );

        DB::commit();
        return $this->basePresenter->paginated($res, ClientResource::class);
    }


    /**
     * @throws UniqueViolationException
     */
    public function create(ClientsCreateRequest $request): Response
    {
        DB::beginTransaction();
        if ($this->clientsRepo->find(phone: $request->input('phone'))) {
            throw new UniqueViolationException(['phone']);
        }

        $res = $this->clientsRepo->create([
            'name' => $request->input('name'),
            'sex' => $request->input('sex'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::commit();
        return $this->basePresenter->success(new ClientResource($res));
    }


    public function update(ClientsUpdateRequest $request): Response
    {
        return response(['status' => 'wip']);
    }


    /**
     * @throws NotFoundException
     */
    public function delete(ClientsDeleteRequest $request): Response
    {
        DB::beginTransaction();
        $res = $this->clientsRepo->delete($request->input('clientId'));
        if (!$res) throw new NotFoundException();

        DB::commit();
        return $this->basePresenter->success();
    }

}
