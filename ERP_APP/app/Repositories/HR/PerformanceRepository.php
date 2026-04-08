<?php

namespace App\Repositories\HR;

use App\Models\HR\Performance;

/**
 * Class PerformanceRepository
 *
 * Repository for managing Performance resources.
 * Provides CRUD operations with JSON responses.
 */
class PerformanceRepository
{
    /**
     * @var PerformanceRepository
     */
    protected $performanceRepository;

    /**
     * PerformanceRepository constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Performance records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->performanceRepository->all();
    }

    /**
     * Display a paginated listing of Performance resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Performance resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Performance resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Performance resource in storage.
     *
     * @param PerformanceRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Performance resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
