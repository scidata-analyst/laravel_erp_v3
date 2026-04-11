<?php

namespace App\Http\Controllers\UsersRoles;

use App\Services\UsersRoles\UserService;
use App\Http\Requests\UsersRoles\UserStoreRequest;
use App\Http\Requests\UsersRoles\UserUpdateRequest;
use App\Http\Resources\UsersRoles\UserResource;
use App\Http\Controllers\Controller;

/**
 * Class UserController
 *
 * Controller for managing User resources.
 * Provides CRUD operations with JSON responses.
 */
class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UserController constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display all User records without pagination.
     *
     */
    public function all()
    {
        $data = $this->userService->all();

        return response()->json([
            "success" => true,
            "message" => "All User records fetched successfully",
            "data" => UserResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of User resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->userService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "User records fetched successfully",
            "data" => UserResource::collection($data)
        ]);
    }

    /**
     * Store a newly created User resource in storage.
     *
     * @param UserStoreRequest $request
     */
    public function store(UserStoreRequest $request)
    {
        $data = $this->userService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "User record created successfully",
            "data" => new UserResource($data)
        ], 201);
    }

    /**
     * Display the specified User resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->userService->show($id);

        return response()->json([
            "success" => true,
            "message" => "User record fetched successfully",
            "data" => new UserResource($data)
        ]);
    }

    /**
     * Update the specified User resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param int $id
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $data = $this->userService->update($request->validated(), $id);

        return response()->json([
            "success" => true,
            "message" => "User record updated successfully",
            "data" => new UserResource($data)
        ]);
    }

    /**
     * Remove the specified User resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->userService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "User record deleted successfully"
        ]);
    }
}
