<?php

namespace App\Services\Projects;

use App\Models\Projects\Tasks;

/**
 * Class TasksService
 *
 * Service for managing Tasks resources.
 * Provides CRUD operations with JSON responses.
 */
class TasksService
{
    /**
     * @var TasksService
     */
    protected $tasksService;

    /**
     * TasksService constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Tasks records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->tasksService->all();
    }

    /**
     * Display a paginated listing of Tasks resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Tasks resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Tasks resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Tasks resource in storage.
     *
     * @param TasksRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Tasks resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
