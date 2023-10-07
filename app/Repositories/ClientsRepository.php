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
        ?string      $q = null,
    ): LengthAwarePaginator
    {
        return DB::table('clients')
            ->when($q, static fn(Builder $builder) => $builder->orWhere('name', 'ILIKE', "%$q%"))
            ->when($q, static fn(Builder $builder) => $builder->orWhere('phone', 'ILIKE', "%$q%"))
            ->paginate(
                perPage: $paginator->perPage,
                page: $paginator->currentPage,
            );
    }

    public function delete(
        int $id,
    ): bool
    {
        return DB::table('clients')
            ->delete($id);
    }
}
