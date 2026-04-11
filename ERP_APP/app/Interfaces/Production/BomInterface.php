<?php

namespace App\Interfaces\Production;


/**
 * Class BomInterface
 *
 * Interface for managing Bom resources.
 * Provides CRUD operations with JSON responses.
 */
interface BomInterface
{
    /**
     * Display all Bom records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Bom resources.
     *
     */
    public function index();

    /**
     * Store a newly created Bom resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Bom resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Bom resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Bom resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
