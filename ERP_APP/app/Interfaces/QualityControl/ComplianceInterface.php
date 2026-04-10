<?php

namespace App\Interfaces\QualityControl;


/**
 * Class ComplianceInterface
 *
 * Interface for managing Compliance resources.
 * Provides CRUD operations with JSON responses.
 */
interface ComplianceInterface
{
    /**
     * Display all Compliance records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Compliance resources.
     *
     */
    public function index();

    /**
     * Store a newly created Compliance resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Compliance resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Compliance resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Compliance resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
