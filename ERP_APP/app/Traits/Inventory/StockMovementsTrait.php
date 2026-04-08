<?php

namespace App\Traits\Inventory;

use App\Models\Inventory\StockMovements;

/**
 * Class StockMovementsTrait
 *
 * Trait for managing StockMovements resources.
 * Provides CRUD operations with JSON responses.
 */
trait StockMovementsTrait
{
    /**
     * @var StockMovementsTrait
     */
    protected $stockMovementsTrait;

    /**
     * StockMovementsTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all StockMovements records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->stockMovementsTrait->all();
    }

    /**
     * Display a paginated listing of StockMovements resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created StockMovements resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified StockMovements resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified StockMovements resource in storage.
     *
     * @param StockMovementsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified StockMovements resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
