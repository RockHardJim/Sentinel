<?php

namespace App\Modules\Shared\Repositories;

use App\Modules\Shared\Interfaces\iBaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class baseRepository implements iBaseRepository
{

    public function __construct(protected Model $model)
    {
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id, array $columns = ['*'], array $relations = []): Model
    {
        return $this->findByCriteria(
            ['id' => $id],
            $columns,
            $relations
        );
    }

    /**
     * @inheritDoc
     */
    public function findByCriteria(array $criteria, array $columns = ['*'], array $relations = []): Model
    {
        return $this->customQuery()
            ->select($columns)
            ->with($relations)
            ->where($criteria)
            ->firstOrFail();
    }

    /**
     * @inheritDoc
     */
    public function getByCriteria(array $criteria, array $columns = ['*'], array $relations = []): Collection
    {
        return $this->customQuery()
            ->select($columns)
            ->with($relations)
            ->where($criteria)
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            return $this->model->create($data);
        });
    }

    /**
     * @inheritDoc
     */
    public function update(Model $model, array $data): Model
    {
        return DB::transaction(function () use ($model, $data) {
            $model->update($data);
            $model->save();
            return $model->fresh();
        });
    }

    /**
     * @inheritDoc
     */
    public function delete(Model $model): bool
    {
        return DB::transaction(function () use ($model) {
            return $model->delete();
        });
    }

    /**
     * @inheritDoc
     */
    public function customQuery(): Builder
    {
        return $this->model->newQuery();
    }
}
