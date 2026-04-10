<?php

namespace App\Traits\HR;

use App\Models\HR\Performance;

/**
 * Class PerformanceTrait
 *
 * Trait for managing Performance resources.
 * Provides CRUD operations with JSON responses.
 */
trait PerformanceTrait
{
    /**
     * @var PerformanceTrait
     */
    protected $performanceTrait;

    /**
     * PerformanceTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Performance records without pagination.
     *
     */
    public function all()
    {
        $data = $this->performanceTrait->all();
    }

    /**
     * Display a paginated listing of Performance resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Performance resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Performance resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Performance resource in storage.
     *
     * @param PerformanceRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified Performance resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
