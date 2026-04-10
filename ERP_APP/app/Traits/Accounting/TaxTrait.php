<?php

namespace App\Traits\Accounting;

use App\Models\Accounting\Tax;

/**
 * Class TaxTrait
 *
 * Trait for managing Tax resources.
 * Provides CRUD operations with JSON responses.
 */
trait TaxTrait
{
    /**
     * @var TaxTrait
     */
    protected $taxTrait;

    /**
     * TaxTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Tax records without pagination.
     *
     */
    public function all()
    {
        $data = $this->taxTrait->all();
    }

    /**
     * Display a paginated listing of Tax resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Tax resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Tax resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Tax resource in storage.
     *
     * @param TaxRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified Tax resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
