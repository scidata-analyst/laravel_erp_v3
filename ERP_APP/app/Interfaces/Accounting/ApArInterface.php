<?php

namespace App\Interfaces\Accounting;


/**
 * Class ApArInterface
 *
 * Interface for managing ApAr resources.
 * Provides CRUD operations with JSON responses.
 */
interface ApArInterface
{
    /**
     * Display all ApAr records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of ApAr resources.
     *
     */
    public function index();

    /**
     * Store a newly created ApAr resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified ApAr resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified ApAr resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified ApAr resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
