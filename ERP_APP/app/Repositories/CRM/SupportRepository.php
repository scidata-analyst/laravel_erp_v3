<?php

namespace App\Repositories\CRM;

use App\Models\CRM\Support;

/**
 * Class SupportRepository
 *
 * Repository for managing Support resources.
 * Provides CRUD operations with JSON responses.
 */
class SupportRepository
{
    /**
     * @var SupportRepository
     */
    protected $supportRepository;

    /**
     * SupportRepository constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Support records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->supportRepository->all();
    }

    /**
     * Display a paginated listing of Support resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Support resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Support resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Support resource in storage.
     *
     * @param SupportRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Support resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
