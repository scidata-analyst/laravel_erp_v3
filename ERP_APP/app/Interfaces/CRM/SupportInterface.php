<?php

namespace App\Interfaces\CRM;


/**
 * Class SupportInterface
 *
 * Interface for managing Support resources.
 * Provides CRUD operations with JSON responses.
 */
interface SupportInterface
{
    /**
     * Display all Support records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Support resources.
     *
     */
    public function index();

    /**
     * Store a newly created Support resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Support resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Support resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Support resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
