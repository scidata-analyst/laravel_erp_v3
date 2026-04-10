<?php

namespace App\Interfaces\CRM;


/**
 * Class LeadsInterface
 *
 * Interface for managing Leads resources.
 * Provides CRUD operations with JSON responses.
 */
interface LeadsInterface
{
    /**
     * Display all Leads records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Leads resources.
     *
     */
    public function index();

    /**
     * Store a newly created Leads resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Leads resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Leads resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Leads resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
