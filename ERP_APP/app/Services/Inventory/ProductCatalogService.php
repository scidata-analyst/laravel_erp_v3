<?php

namespace App\Services\Inventory;

use App\Models\Inventory\ProductCatalog;
use App\Interfaces\Inventory\ProductCatalogInterface;

class ProductCatalogService implements ProductCatalogInterface
{
    /**
     * @var ProductCatalogService
     */
    protected $productCatalogService;

    /**
     * ProductCatalogService constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all ProductCatalog records without pagination.
     *
     */
    public function all()
    {
        $data = $this->productCatalogService->all();
    }

    /**
     * Display a paginated listing of ProductCatalog resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created ProductCatalog resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified ProductCatalog resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified ProductCatalog resource in storage.
     *
     * @param ProductCatalogRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified ProductCatalog resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
