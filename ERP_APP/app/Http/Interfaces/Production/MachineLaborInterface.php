<?php

namespace App\Http\Interfaces\Production;

/**
 * interface MachineLaborInterface
 *
 * Interface for managing MachineLabor resources.
 * Provides CRUD operations with JSON responses.
 */
interface MachineLaborInterface
{
    /**
     * @var MachineLaborService
     */

    /**
     * Display all MachineLabor records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all();

    /**
     * Display a paginated listing of MachineLabor resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();

    /**
     * Store a newly created MachineLabor resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data);

    /**
     * Display the specified MachineLabor resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id);

    /**
     * Update the specified MachineLabor resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Remove the specified MachineLabor resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id);
}
