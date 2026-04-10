<?php

namespace App\Traits\Projects;

use App\Models\Projects\ProjectCost;

/**
 * Class ProjectCostTrait
 *
 * Trait for managing ProjectCost resources.
 * Provides CRUD operations with JSON responses.
 */
trait ProjectCostTrait
{
    /**
     * @var ProjectCostTrait
     */
    protected $projectCostTrait;

    /**
     * ProjectCostTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all ProjectCost records without pagination.
     *
     */
    public function all()
    {
        $data = $this->projectCostTrait->all();
    }

    /**
     * Display a paginated listing of ProjectCost resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created ProjectCost resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified ProjectCost resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified ProjectCost resource in storage.
     *
     * @param ProjectCostRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified ProjectCost resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
