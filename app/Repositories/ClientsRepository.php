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
        ?int    $id = null,
        ?string $phone = null,
    ): ?Client
    {
        $res = DB::table('clients')
            ->when($id, static fn(Builder $builder) => $builder->where('id', $id))
            ->when($phone, static fn(Builder $builder) => $builder->where('phone', $phone))
            ->first();
        if (!$res) return null;
        return Client::make((array)$res);
    }

    public function findMany(
        PaginatorDTO $paginator,
        ?string      $q = null,
    ): LengthAwarePaginator
    {
        return DB::table('clients')
            ->when($q, static fn(Builder $builder) => $builder->orWhere('name', 'ILIKE', "%$q%"))
            ->when($q, static fn(Builder $builder) => $builder->orWhere('phone', 'ILIKE', "%$q%"))
            ->orderBy('updated_at', 'desc')
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

    /** @return int ID новой сущности */
    public function create(
        array $fields,
    ): int
    {
        $res = DB::table('clients')->insertGetId([
            ...$fields,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return $res;
    }

    public function update(
        int   $id,
        array $fields,
    ): int
    {
        $res = DB::table('clients')
            ->where('id', $id)
            ->update([
                ...$fields,
                'updated_at' => now(),
            ]);
        return $res;
    }

    public function countRecords(): int
    {
        $res = DB::table('clients')
            ->select(DB::raw('count(id) as count'))
            ->get();
        return $res[0]->count;
    }
}
