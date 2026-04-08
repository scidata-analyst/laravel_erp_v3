<?php

namespace App\Traits\CRM;

use App\Models\CRM\Interactions;

/**
 * Class InteractionsTrait
 *
 * Trait for managing Interactions resources.
 * Provides CRUD operations with JSON responses.
 */
trait InteractionsTrait
{
    /**
     * @var InteractionsTrait
     */
    protected $interactionsTrait;

    /**
     * InteractionsTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Interactions records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->interactionsTrait->all();
    }

    /**
     * Display a paginated listing of Interactions resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Interactions resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Interactions resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Interactions resource in storage.
     *
     * @param InteractionsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Interactions resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
