<?php

namespace App\Constants\Inventory;

use App\Models\Inventory\StockMovements;

/**
 * Class StockMovementsConstant
 *
 * Constant for managing StockMovements resources.
 * Provides CRUD operations with JSON responses.
 */
class StockMovementsConstant
{
    /**
     * @var StockMovementsConstant
     */
    protected $stockMovementsConstant;

    /**
     * StockMovementsConstant constructor.
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
        $data = $this->stockMovementsConstant->all();
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
