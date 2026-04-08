<?php

namespace App\Repositories\Accounting;

use App\Models\Accounting\ApAr;

/**
 * Class ApArRepository
 *
 * Repository for managing ApAr resources.
 * Provides CRUD operations with JSON responses.
 */
class ApArRepository
{
    /**
     * @var ApArRepository
     */
    protected $apArRepository;

    /**
     * ApArRepository constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all ApAr records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->apArRepository->all();
    }

    /**
     * Display a paginated listing of ApAr resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created ApAr resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified ApAr resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified ApAr resource in storage.
     *
     * @param ApArRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified ApAr resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
