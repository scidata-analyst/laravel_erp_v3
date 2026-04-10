<?php

namespace App\Traits\Projects;

use App\Models\Projects\Tasks;

/**
 * Class TasksTrait
 *
 * Trait for managing Tasks resources.
 * Provides CRUD operations with JSON responses.
 */
trait TasksTrait
{
    /**
     * @var TasksTrait
     */
    protected $tasksTrait;

    /**
     * TasksTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Tasks records without pagination.
     *
     */
    public function all()
    {
        $data = $this->tasksTrait->all();
    }

    /**
     * Display a paginated listing of Tasks resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Tasks resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Tasks resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Tasks resource in storage.
     *
     * @param TasksRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified Tasks resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
