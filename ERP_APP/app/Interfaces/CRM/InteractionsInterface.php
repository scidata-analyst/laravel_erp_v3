<?php

namespace App\Interfaces\CRM;


/**
 * Class InteractionsInterface
 *
 * Interface for managing Interactions resources.
 * Provides CRUD operations with JSON responses.
 */
interface InteractionsInterface
{
    /**
     * Display all Interactions records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Interactions resources.
     *
     */
    public function index();

    /**
     * Store a newly created Interactions resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Interactions resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Interactions resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Interactions resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
