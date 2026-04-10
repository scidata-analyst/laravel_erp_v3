<?php

namespace App\Interfaces\QualityControl;


/**
 * Class QcChecklistsInterface
 *
 * Interface for managing QcChecklists resources.
 * Provides CRUD operations with JSON responses.
 */
interface QcChecklistsInterface
{
    /**
     * Display all QcChecklists records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of QcChecklists resources.
     *
     */
    public function index();

    /**
     * Store a newly created QcChecklists resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified QcChecklists resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified QcChecklists resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified QcChecklists resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
