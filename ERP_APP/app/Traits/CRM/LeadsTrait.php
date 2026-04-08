<?php

namespace App\Traits\CRM;

use App\Models\CRM\Leads;

/**
 * Class LeadsTrait
 *
 * Trait for managing Leads resources.
 * Provides CRUD operations with JSON responses.
 */
trait LeadsTrait
{
    /**
     * @var LeadsTrait
     */
    protected $leadsTrait;

    /**
     * LeadsTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Leads records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->leadsTrait->all();
    }

    /**
     * Display a paginated listing of Leads resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Leads resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Leads resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Leads resource in storage.
     *
     * @param LeadsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Leads resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
