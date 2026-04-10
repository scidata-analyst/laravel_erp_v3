<?php

namespace App\Traits\Projects;

use App\Models\Projects\Resources;

/**
 * Class ResourcesTrait
 *
 * Trait for managing Resources resources.
 * Provides CRUD operations with JSON responses.
 */
trait ResourcesTrait
{
    /**
     * @var ResourcesTrait
     */
    protected $resourcesTrait;

    /**
     * ResourcesTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Resources records without pagination.
     *
     */
    public function all()
    {
        $data = $this->resourcesTrait->all();
    }

    /**
     * Display a paginated listing of Resources resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Resources resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Resources resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Resources resource in storage.
     *
     * @param ResourcesRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified Resources resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
