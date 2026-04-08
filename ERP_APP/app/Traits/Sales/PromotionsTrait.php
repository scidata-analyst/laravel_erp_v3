<?php

namespace App\Traits\Sales;

use App\Models\Sales\Promotions;

/**
 * Class PromotionsTrait
 *
 * Trait for managing Promotions resources.
 * Provides CRUD operations with JSON responses.
 */
trait PromotionsTrait
{
    /**
     * @var PromotionsTrait
     */
    protected $promotionsTrait;

    /**
     * PromotionsTrait constructor.
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
        $data = $this->promotionsTrait->all();
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
