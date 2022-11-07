<?php
namespace App\Modules\Shared\Interfaces;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Interface iBaseRepository
 * @meta description: "Base repository interface for all repositories"
 * @package App\Modules\Shared\Interfaces
 * @author Tumelo Baloyi <https://github.com/RockHardJim>
 */
interface iBaseRepository
{

    /**
     * Find a model by its primary key.
     * @param int $id
     * @param array $columns
     * @param array $relations
     * @return Model
     * @throws ModelNotFoundException
     * @author Tumelo Baloyi <https://github.com/RockHardJim>
     */
    public function findById(int $id, array $columns = ['*'], array $relations = []): Model;

    /**
     * Find a model by using a custom criteria.
     * @param array $criteria
     * @param array $columns
     * @param array $relations
     * @return Model
     * @throws ModelNotFoundException
     * @author Tumelo Baloyi <https://github.com/RockHardJim>
     */
    public function findByCriteria(array $criteria, array $columns = ['*'], array $relations = []): Model;

    /**
     * Get a collection of models by using a custom criteria.
     * @param array $criteria
     * @param array $columns
     * @param array $relations
     * @return Collection
     * @author Tumelo Baloyi <https://github.com/RockHardJim>
     */
    public function getByCriteria(array $criteria, array $columns = ['*'], array $relations = []): Collection;

    /**
     * Create a new model.
     * @param array $data
     * @return Model
     * @author Tumelo Baloyi <https://github.com/RockHardJim>
     */
    public function create(array $data): Model;

    /**
     * Update a model.
     * @param Model $model
     * @param array $data
     * @return Model
     * @throws Exception
     */
    public function update(Model $model, array $data): Model;

    /**
     * Delete a model.
     * @param Model $model
     * @return bool
     * @throws Exception
     * @author Tumelo Baloyi <https://github.com/RockHardJim>
     */
    public function delete(Model $model): bool;

    /**
     * Get a custom query builder.
     * @return Builder
     * @author Tumelo Baloyi <https://github.com/RockHardJim>
     */
    public function customQuery(): Builder;

}

