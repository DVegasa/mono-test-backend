<?php

namespace App\Repositories;

use App\DTOs\PaginatorDTO;
use App\Models\Client;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ClientsRepository
{
    public function find(
        int $id,
    ): ?Client
    {
        return Client::make(
            (array)
            DB::table('clients')
                ->when($id, static fn(Builder $builder) => $builder->where('id', $id))
                ->first()
        );
    }

    public function findMany(
        PaginatorDTO $paginator,
    ): LengthAwarePaginator
    {
        return DB::table('clients')
            ->paginate(
                perPage: $paginator->perPage,
                page: $paginator->currentPage,
            );
    }
}
