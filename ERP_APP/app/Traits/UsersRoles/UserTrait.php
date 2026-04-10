<?php

namespace App\Traits\UsersRoles;

use App\Models\UsersRoles\User;

/**
 * Class UserTrait
 *
 * Trait for managing User resources.
 * Provides CRUD operations with JSON responses.
 */
trait UserTrait
{
    /**
     * @var UserTrait
     */
    protected $userTrait;

    /**
     * UserTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all User records without pagination.
     *
     */
    public function all()
    {
        $data = $this->userTrait->all();
    }

    /**
     * Display a paginated listing of User resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created User resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified User resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified User resource in storage.
     *
     * @param UserRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified User resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
