<?php

namespace App\Interfaces\Sales;


/**
 * Class InvoicesInterface
 *
 * Interface for managing Invoices resources.
 * Provides CRUD operations with JSON responses.
 */
interface InvoicesInterface
{
    /**
     * Display all Invoices records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Invoices resources.
     *
     */
    public function index();

    /**
     * Store a newly created Invoices resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Invoices resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Invoices resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Invoices resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
