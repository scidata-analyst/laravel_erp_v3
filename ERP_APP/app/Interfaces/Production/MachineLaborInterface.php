<?php

namespace App\Interfaces\Production;


/**
 * Class MachineLaborInterface
 *
 * Interface for managing MachineLabor resources.
 * Provides CRUD operations with JSON responses.
 */
interface MachineLaborInterface
{
    /**
     * Display all MachineLabor records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of MachineLabor resources.
     *
     */
    public function index();

    /**
     * Store a newly created MachineLabor resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified MachineLabor resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified MachineLabor resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified MachineLabor resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
