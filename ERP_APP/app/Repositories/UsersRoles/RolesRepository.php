<?php

namespace App\Repositories\UsersRoles;

use App\Models\UsersRoles\Roles;
use App\Interfaces\UsersRoles\RolesInterface;

/**
 * Class RolesRepository
 *
 * Repository for managing Roles resources.
 * Provides CRUD operations with database queries.
 */
class RolesRepository implements RolesInterface
{
    /**
     * @var Roles
     */
    protected $model;

    /**
     * RolesRepository constructor.
     *
     * @param Roles $model
     */
    public function __construct(Roles $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Roles records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Roles resources.
     *
     * @param int $perPage
     * @param string $search
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function index($perPage = 15, $search = '', $filters = [])
    {
        $query = $this->model->query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created Roles resource in storage.
     *
     * @param array $data
     * @return \App\Models\UsersRoles\Roles
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Roles resource.
     *
     * @param int $id
     * @return \App\Models\UsersRoles\Roles
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Roles resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\UsersRoles\Roles
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Roles resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        return $record->delete();
    }
}