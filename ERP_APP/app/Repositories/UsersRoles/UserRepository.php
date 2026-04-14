<?php

namespace App\Repositories\UsersRoles;

use App\Models\UsersRoles\User;
use App\Interfaces\UsersRoles\UserInterface;

/**
 * Class UserRepository
 *
 * Repository for managing User resources.
 * Provides CRUD operations with database queries.
 */
class UserRepository implements UserInterface
{
    /**
     * @var User
     */
    protected $model;

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Display all User records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of User resources.
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

        $query->with('role');

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created User resource in storage.
     *
     * @param array $data
     * @return \App\Models\UsersRoles\User
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified User resource.
     *
     * @param int $id
     * @return \App\Models\UsersRoles\User
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified User resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\UsersRoles\User
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified User resource from storage.
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