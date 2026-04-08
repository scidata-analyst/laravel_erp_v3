<?php

namespace App\Constants\Inventory;

use App\Models\Inventory\StockValuation;

/**
 * Class StockValuationConstant
 *
 * Constant for managing StockValuation resources.
 * Provides CRUD operations with JSON responses.
 */
class StockValuationConstant
{
    /**
     * @var StockValuationConstant
     */
    protected $stockValuationConstant;

    /**
     * StockValuationConstant constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all StockValuation records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->stockValuationConstant->all();
    }

    /**
     * Display a paginated listing of StockValuation resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created StockValuation resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified StockValuation resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified StockValuation resource in storage.
     *
     * @param StockValuationRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified StockValuation resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
