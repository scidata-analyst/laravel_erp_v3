<?php

namespace App\Interfaces\Purchase;


/**
 * Class SuppliersInterface
 *
 * Interface for managing Suppliers resources.
 * Provides CRUD operations with JSON responses.
 */
interface SuppliersInterface
{
    /**
     * Display all Suppliers records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Suppliers resources.
     *
     */
    public function index();

    /**
     * Store a newly created Suppliers resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Suppliers resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Suppliers resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Suppliers resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
