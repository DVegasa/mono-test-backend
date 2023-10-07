<?php

namespace App\Http\Controllers;

use App\Exceptions\DevException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DevController extends Controller
{
    public function ping(Request $request): Response
    {
        return $this->basePresenter->success([
            'ping' => 'pong',
        ]);
    }


    /**
     * @throws DevException
     */
    public function errorPing(Request $request): Response
    {
        throw new DevException();
    }
}
