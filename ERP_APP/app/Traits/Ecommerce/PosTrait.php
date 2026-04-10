<?php

namespace App\Traits\Ecommerce;

use App\Models\Ecommerce\Pos;

/**
 * Class PosTrait
 *
 * Trait for managing Pos resources.
 * Provides CRUD operations with JSON responses.
 */
trait PosTrait
{
    /**
     * @var PosTrait
     */
    protected $posTrait;

    /**
     * PosTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Pos records without pagination.
     *
     */
    public function all()
    {
        $data = $this->posTrait->all();
    }

    /**
     * Display a paginated listing of Pos resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Pos resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Pos resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Pos resource in storage.
     *
     * @param PosRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified Pos resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
