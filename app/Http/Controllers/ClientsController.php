<?php

namespace App\Http\Controllers;

use App\DTOs\PaginatorDTO;
use App\Exceptions\NotFoundException;
use App\Http\Presenters\BasePresenter;
use App\Http\Requests\ClientsCreateRequest;
use App\Http\Requests\ClientsDeleteRequest;
use App\Http\Requests\ClientsGetListRequest;
use App\Http\Requests\ClientsGetRequest;
use App\Http\Requests\ClientsUpdateRequest;
use App\Http\Resources\ClientResource;
use App\Repositories\ClientsRepository;
use Illuminate\Http\Response;

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
        $data = $this->clientsRepo->find($request->input('clientId'));
        if (!$data) throw new NotFoundException();
        return $this->basePresenter->success(new ClientResource($data));
    }


    public function getList(ClientsGetListRequest $request): Response
    {
        $data = $this->clientsRepo->findMany(
            paginator: PaginatorDTO::fromRequest($request),
            q: $request->input('q'),
        );
        return $this->basePresenter->paginated($data, ClientResource::class);
    }


    public function create(ClientsCreateRequest $request): Response
    {
        return response(['status' => 'wip']);
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
        $data = $this->clientsRepo->delete($request->input('clientId'));
        if (!$data) throw new NotFoundException();
        return $this->basePresenter->success();
    }

}
