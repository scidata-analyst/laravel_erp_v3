<?php

namespace App\Interfaces\Inventory;


/**
 * Class StockMovementsInterface
 *
 * Interface for managing StockMovements resources.
 * Provides CRUD operations with JSON responses.
 */
interface StockMovementsInterface
{
    /**
     * Display all StockMovements records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of StockMovements resources.
     *
     */
    public function index();

    /**
     * Store a newly created StockMovements resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified StockMovements resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified StockMovements resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified StockMovements resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
