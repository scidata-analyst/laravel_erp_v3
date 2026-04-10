<?php

namespace App\Traits\CRM;

use App\Models\CRM\Support;

/**
 * Class SupportTrait
 *
 * Trait for managing Support resources.
 * Provides CRUD operations with JSON responses.
 */
trait SupportTrait
{
    /**
     * @var SupportTrait
     */
    protected $supportTrait;

    /**
     * SupportTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Support records without pagination.
     *
     */
    public function all()
    {
        $data = $this->supportTrait->all();
    }

    /**
     * Display a paginated listing of Support resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Support resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Support resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Support resource in storage.
     *
     * @param SupportRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified Support resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
