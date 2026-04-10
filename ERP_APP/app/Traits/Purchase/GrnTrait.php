<?php

namespace App\Traits\Purchase;

use App\Models\Purchase\Grn;

/**
 * Class GrnTrait
 *
 * Trait for managing Grn resources.
 * Provides CRUD operations with JSON responses.
 */
trait GrnTrait
{
    /**
     * @var GrnTrait
     */
    protected $grnTrait;

    /**
     * GrnTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Grn records without pagination.
     *
     */
    public function all()
    {
        $data = $this->grnTrait->all();
    }

    /**
     * Display a paginated listing of Grn resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Grn resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Grn resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Grn resource in storage.
     *
     * @param GrnRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified Grn resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
