<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\ProductCatalog;
use App\Interfaces\Inventory\ProductCatalogInterface;

/**
 * Class ProductCatalogRepository
 *
 * Repository for managing ProductCatalog resources.
 * Provides CRUD operations with database queries.
 */
class ProductCatalogRepository implements ProductCatalogInterface
{
    /**
     * @var ProductCatalog
     */
    protected $model;

    /**
     * ProductCatalogRepository constructor.
     *
     * @param ProductCatalog $model
     */
    public function __construct(ProductCatalog $model)
    {
        $this->model = $model;
    }

    /**
     * Display all ProductCatalog records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of ProductCatalog resources.
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
            $query->where('product_name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created ProductCatalog resource in storage.
     *
     * @param array $data
     * @return \App\Models\Inventory\ProductCatalog
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified ProductCatalog resource.
     *
     * @param int $id
     * @return \App\Models\Inventory\ProductCatalog
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified ProductCatalog resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Inventory\ProductCatalog
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified ProductCatalog resource from storage.
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
