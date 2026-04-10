<?php

namespace App\Interfaces\QualityControl;


/**
 * Class DefectsInterface
 *
 * Interface for managing Defects resources.
 * Provides CRUD operations with JSON responses.
 */
interface DefectsInterface
{
    /**
     * Display all Defects records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Defects resources.
     *
     */
    public function index();

    /**
     * Store a newly created Defects resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Defects resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Defects resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Defects resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
