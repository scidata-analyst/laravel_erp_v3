<?php

namespace App\Interfaces\Inventory;


/**
 * Class ProductCatalogInterface
 *
 * Interface for managing ProductCatalog resources.
 * Provides CRUD operations with JSON responses.
 */
interface ProductCatalogInterface
{
    /**
     * Display all ProductCatalog records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of ProductCatalog resources.
     *
     */
    public function index();

    /**
     * Store a newly created ProductCatalog resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified ProductCatalog resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified ProductCatalog resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified ProductCatalog resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
