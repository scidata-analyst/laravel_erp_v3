<?php

namespace App\Interfaces\Ecommerce;


/**
 * Class InvSyncInterface
 *
 * Interface for managing InvSync resources.
 * Provides CRUD operations with JSON responses.
 */
interface InvSyncInterface
{
    /**
     * Display all InvSync records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of InvSync resources.
     *
     */
    public function index();

    /**
     * Store a newly created InvSync resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified InvSync resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified InvSync resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified InvSync resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
