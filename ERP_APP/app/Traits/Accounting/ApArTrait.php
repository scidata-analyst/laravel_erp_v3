<?php

namespace App\Traits\Accounting;

use App\Models\Accounting\ApAr;

/**
 * Class ApArTrait
 *
 * Trait for managing ApAr resources.
 * Provides CRUD operations with JSON responses.
 */
trait ApArTrait
{
    /**
     * @var ApArTrait
     */
    protected $apArTrait;

    /**
     * ApArTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all ApAr records without pagination.
     *
     */
    public function all()
    {
        $data = $this->apArTrait->all();
    }

    /**
     * Display a paginated listing of ApAr resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created ApAr resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified ApAr resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified ApAr resource in storage.
     *
     * @param ApArRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified ApAr resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
