<?php

namespace App\Interfaces\Inventory;


/**
 * Class StockValuationInterface
 *
 * Interface for managing StockValuation resources.
 * Provides CRUD operations with JSON responses.
 */
interface StockValuationInterface
{
    /**
     * Display all StockValuation records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of StockValuation resources.
     *
     */
    public function index();

    /**
     * Store a newly created StockValuation resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified StockValuation resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified StockValuation resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified StockValuation resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
