<?php

namespace App\Constants\Sales;

use App\Models\Sales\Promotions;

/**
 * Class PromotionsConstant
 *
 * Constant for managing Promotions resources.
 * Provides CRUD operations with JSON responses.
 */
class PromotionsConstant
{
    /**
     * @var PromotionsConstant
     */
    protected $promotionsConstant;

    /**
     * PromotionsConstant constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Promotions records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->promotionsConstant->all();
    }

    /**
     * Display a paginated listing of Promotions resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Promotions resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Promotions resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Promotions resource in storage.
     *
     * @param PromotionsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Promotions resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
