<?php

namespace App\Traits\Ecommerce;

use App\Models\Ecommerce\InvSync;

/**
 * Class InvSyncTrait
 *
 * Trait for managing InvSync resources.
 * Provides CRUD operations with JSON responses.
 */
trait InvSyncTrait
{
    /**
     * @var InvSyncTrait
     */
    protected $invSyncTrait;

    /**
     * InvSyncTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all InvSync records without pagination.
     *
     */
    public function all()
    {
        $data = $this->invSyncTrait->all();
    }

    /**
     * Display a paginated listing of InvSync resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created InvSync resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified InvSync resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified InvSync resource in storage.
     *
     * @param InvSyncRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified InvSync resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
