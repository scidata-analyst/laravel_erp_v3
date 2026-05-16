<?php

namespace App\Repositories\Core;

use App\Models\Core\Settings;
use App\Interfaces\Core\SettingsInterface;

/**
 * Class SettingsRepository
 *
 * Repository for managing Settings resources.
 * Provides CRUD operations with database queries.
 */
class SettingsRepository implements SettingsInterface
{
    /**
     * @var Settings
     */
    protected $model;

    /**
     * SettingsRepository constructor.
     *
     * @param Settings $model
     */
    public function __construct(Settings $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Settings records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Settings resources.
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
            $query->where('key', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created Settings resource in storage.
     *
     * @param array $data
     * @return \App\Models\Core\Settings
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Settings resource.
     *
     * @param int $id
     * @return \App\Models\Core\Settings
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Settings resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Core\Settings
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Settings resource from storage.
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