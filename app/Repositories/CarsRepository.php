<?php

namespace App\Repositories;

use App\DTOs\PaginatorDTO;
use App\Models\Car;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CarsRepository
{
    public function find(
        ?int    $id = null,
        ?string $plate = null,
    ): ?Car
    {
        $res = DB::table('cars')
            ->when($id, static fn(Builder $builder) => $builder->where('id', $id))
            ->when($plate, static fn(Builder $builder) => $builder->where('plate', $plate))
            ->first();
        if (!$res) return null;
        return Car::make((array)$res);
    }

    public function findMany(
        PaginatorDTO $paginator,
        ?int         $ownerId = null,
        ?string      $q = null,
    ): LengthAwarePaginator
    {
        return DB::table('cars')
            ->when($ownerId, static fn(Builder $builder) => $builder->where('owner_id', "$ownerId"))
            ->where(function (Builder $group) use ($q) {
                $group->when($q, static fn(Builder $builder) => $builder
                    ->orWhere('plate', 'ILIKE', "%$q%")
                    ->orWhere('model', 'ILIKE', "%$q%")
                    ->orWhere('brand', 'ILIKE', "%$q%")
                );
            })
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
        return DB::table('cars')
            ->delete($id);
    }

    /** @return int ID новой сущности */
    public function create(
        array $fields,
    ): int
    {
        $res = DB::table('cars')->insertGetId($fields);
        return $res;
    }

    public function update(
        int   $id,
        array $fields,
    ): int
    {
        $res = DB::table('cars')
            ->where('id', $id)
            ->update($fields);
        return $res;
    }

    public function switchParking(
        int $id,
    ): int
    {
        $res = DB::table('cars')
            ->where('id', $id)
            ->update([
                'is_parked' => DB::raw('NOT is_parked'),
            ]);
        return $res;
    }
}
