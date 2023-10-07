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

        $id = $this->clientsRepo->create([
            'name' => $request->input('name'),
            'sex' => $request->input('sex'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $res = $this->clientsRepo->find(id: $id);

        DB::commit();
        return $this->basePresenter->success(new ClientResource($res));
    }


    /**
     * @throws NotFoundException
     * @throws UniqueViolationException
     */
    public function update(ClientsUpdateRequest $request): Response
    {
        DB::beginTransaction();
        $id = $request->input('clientId');

        if (!$this->clientsRepo->find(id: $id)) throw new NotFoundException();
        if ($this->clientsRepo->find(phone: $request->input('phone'))) throw new UniqueViolationException(['phone']);

        $this->clientsRepo->update($id, [
            'name' => $request->input('name'),
            'sex' => $request->input('sex'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'updated_at' => now(),
        ]);
        $res = $this->clientsRepo->find(id: $id);

        DB::commit();
        return $this->basePresenter->success(new ClientResource($res));
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
