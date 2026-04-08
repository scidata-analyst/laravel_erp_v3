<?php

namespace App\Http\Interfaces\Inventory;

/**
 * interface ProductCatalogInterface
 *
 * Interface for managing ProductCatalog resources.
 * Provides CRUD operations with JSON responses.
 */
interface ProductCatalogInterface
{
    /**
     * @var ProductCatalogService
     */

    /**
     * Display all ProductCatalog records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all();

    /**
     * Display a paginated listing of ProductCatalog resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();

    /**
     * Store a newly created ProductCatalog resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data);

    /**
     * Display the specified ProductCatalog resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id);

    /**
     * Update the specified ProductCatalog resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Remove the specified ProductCatalog resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id);
}
