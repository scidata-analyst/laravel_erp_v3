<?php

namespace App\Interfaces\Accounting;


/**
 * Class TaxInterface
 *
 * Interface for managing Tax resources.
 * Provides CRUD operations with JSON responses.
 */
interface TaxInterface
{
    /**
     * Display all Tax records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Tax resources.
     *
     */
    public function index();

    /**
     * Store a newly created Tax resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Tax resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Tax resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Tax resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
