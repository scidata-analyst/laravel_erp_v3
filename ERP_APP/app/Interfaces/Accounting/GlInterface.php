<?php

namespace App\Interfaces\Accounting;


/**
 * Class GlInterface
 *
 * Interface for managing Gl resources.
 * Provides CRUD operations with JSON responses.
 */
interface GlInterface
{
    /**
     * Display all Gl records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Gl resources.
     *
     */
    public function index();

    /**
     * Store a newly created Gl resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Gl resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Gl resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Gl resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
