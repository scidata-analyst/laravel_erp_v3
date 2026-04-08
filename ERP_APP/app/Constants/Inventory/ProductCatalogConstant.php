<?php

namespace App\Constants\Inventory;

use App\Models\Inventory\ProductCatalog;

/**
 * Class ProductCatalogConstant
 *
 * Constant for managing ProductCatalog resources.
 * Provides CRUD operations with JSON responses.
 */
class ProductCatalogConstant
{
    /**
     * @var ProductCatalogConstant
     */
    protected $productCatalogConstant;

    /**
     * ProductCatalogConstant constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all ProductCatalog records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->productCatalogConstant->all();
    }

    /**
     * Display a paginated listing of ProductCatalog resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created ProductCatalog resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified ProductCatalog resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified ProductCatalog resource in storage.
     *
     * @param ProductCatalogRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified ProductCatalog resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
