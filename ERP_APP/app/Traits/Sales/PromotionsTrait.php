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
     */
    public function all()
    {
        $data = $this->promotionsTrait->all();
    }

    /**
     * Display a paginated listing of Promotions resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Promotions resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Promotions resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Promotions resource in storage.
     *
     * @param PromotionsRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified Promotions resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
