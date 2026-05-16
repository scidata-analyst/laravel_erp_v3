<?php

namespace App\Interfaces\Sales;


/**
 * Class PromotionsInterface
 *
 * Interface for managing Promotions resources.
 * Provides CRUD operations with JSON responses.
 */
interface PromotionsInterface
{
    /**
     * Display all Promotions records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Promotions resources.
     *
     */
    public function index();

    /**
     * Store a newly created Promotions resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Promotions resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Promotions resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Promotions resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
