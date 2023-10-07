<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarsCreateRequest;
use App\Http\Requests\CarsDeleteRequest;
use App\Http\Requests\CarsGetListRequest;
use App\Http\Requests\CarsGetRequest;
use App\Http\Requests\CarsUpdateRequest;
use Illuminate\Http\Response;

class CarsController extends Controller
{

    public function get(CarsGetRequest $request): Response
    {
        return response(['status' => 'wip']);
    }

    public function getList(CarsGetListRequest $request): Response
    {
        return response(['status' => 'wip']);
    }

    public function create(CarsCreateRequest $request): Response
    {
        return response(['status' => 'wip']);
    }

    public function update(CarsUpdateRequest $request): Response
    {
        return response(['status' => 'wip']);
    }

    public function delete(CarsDeleteRequest $request): Response
    {
        return response(['status' => 'wip']);
    }
}
