<?php

namespace App\Interfaces\Purchase;


/**
 * Class GrnInterface
 *
 * Interface for managing Grn resources.
 * Provides CRUD operations with JSON responses.
 */
interface GrnInterface
{
    /**
     * Display all Grn records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Grn resources.
     *
     */
    public function index();

    /**
     * Store a newly created Grn resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Grn resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Grn resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Grn resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
