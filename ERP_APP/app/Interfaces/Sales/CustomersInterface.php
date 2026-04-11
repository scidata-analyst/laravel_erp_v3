<?php

namespace App\Interfaces\Sales;


/**
 * Class CustomersInterface
 *
 * Interface for managing Customers resources.
 * Provides CRUD operations with JSON responses.
 */
interface CustomersInterface
{
    /**
     * Display all Customers records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Customers resources.
     *
     */
    public function index();

    /**
     * Store a newly created Customers resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Customers resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Customers resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Customers resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
