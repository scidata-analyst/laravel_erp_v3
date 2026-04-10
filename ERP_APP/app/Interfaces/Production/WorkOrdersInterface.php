<?php

namespace App\Interfaces\Production;


/**
 * Class WorkOrdersInterface
 *
 * Interface for managing WorkOrders resources.
 * Provides CRUD operations with JSON responses.
 */
interface WorkOrdersInterface
{
    /**
     * Display all WorkOrders records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of WorkOrders resources.
     *
     */
    public function index();

    /**
     * Store a newly created WorkOrders resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified WorkOrders resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified WorkOrders resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified WorkOrders resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
