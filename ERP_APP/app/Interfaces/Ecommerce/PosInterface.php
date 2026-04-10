<?php

namespace App\Interfaces\Ecommerce;


/**
 * Class PosInterface
 *
 * Interface for managing Pos resources.
 * Provides CRUD operations with JSON responses.
 */
interface PosInterface
{
    /**
     * Display all Pos records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Pos resources.
     *
     */
    public function index();

    /**
     * Store a newly created Pos resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Pos resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Pos resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Pos resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
