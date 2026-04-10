<?php

namespace App\Repositories\Ecommerce;

use App\Models\Ecommerce\OnlineChannels;
use App\Interfaces\Ecommerce\OnlineChannelsInterface;

/**
 * Class OnlineChannelsRepository
 *
 * Repository for managing OnlineChannels resources.
 * Provides CRUD operations with database queries.
 */
class OnlineChannelsRepository implements OnlineChannelsInterface
{
    /**
     * @var OnlineChannels
     */
    protected $model;

    /**
     * OnlineChannelsRepository constructor.
     *
     * @param OnlineChannels $model
     */
    public function __construct(OnlineChannels $model)
    {
        $this->model = $model;
    }

    /**
     * Display all OnlineChannels records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of OnlineChannels resources.
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
     * Store a newly created OnlineChannels resource in storage.
     *
     * @param array $data
     * @return \App\Models\Ecommerce\OnlineChannels
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified OnlineChannels resource.
     *
     * @param int $id
     * @return \App\Models\Ecommerce\OnlineChannels
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified OnlineChannels resource in storage.
     *s
     * @param int $id
     * @param array $data
     * @return \App\Models\Ecommerce\OnlineChannels
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified OnlineChannels resource from storage.
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