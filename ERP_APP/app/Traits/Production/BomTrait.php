<?php

namespace App\Traits\Production;

use App\Models\Production\Bom;

/**
 * Class BomTrait
 *
 * Trait for managing Bom resources.
 * Provides CRUD operations with JSON responses.
 */
trait BomTrait
{
    /**
     * @var BomTrait
     */
    protected $bomTrait;

    /**
     * BomTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Bom records without pagination.
     *
     */
    public function all()
    {
        $data = $this->bomTrait->all();
    }

    /**
     * Display a paginated listing of Bom resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Bom resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Bom resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Bom resource in storage.
     *
     * @param BomRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified Bom resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
