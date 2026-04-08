<?php

namespace App\Constants\Production;

use App\Models\Production\MachineLabor;

/**
 * Class MachineLaborConstant
 *
 * Constant for managing MachineLabor resources.
 * Provides CRUD operations with JSON responses.
 */
class MachineLaborConstant
{
    /**
     * @var MachineLaborConstant
     */
    protected $machineLaborConstant;

    /**
     * MachineLaborConstant constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all MachineLabor records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->machineLaborConstant->all();
    }

    /**
     * Display a paginated listing of MachineLabor resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created MachineLabor resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified MachineLabor resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified MachineLabor resource in storage.
     *
     * @param MachineLaborRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified MachineLabor resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
