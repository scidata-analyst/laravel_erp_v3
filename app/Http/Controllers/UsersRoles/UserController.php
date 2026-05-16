<?php

namespace App\Http\Controllers\UsersRoles;

use App\Services\UsersRoles\UserService;
use App\Http\Requests\UsersRoles\UserStoreRequest;
use App\Http\Requests\UsersRoles\UserUpdateRequest;
use App\Http\Resources\UsersRoles\UserResource;
use App\Http\Controllers\Controller;
use App\Models\User;

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

        return UserResource::collection($data)
            ->additional([
                'success' => true,
                'message' => 'User records fetched successfully',
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

        return view("users_roles.user", compact("data"));
    }

    /**
     * Store a newly created User resource in storage.
     *
     * @param UserStoreRequest $request
     */
    public function store(UserStoreRequest $request)
    {
        $data = $this->userService->store($request->validated());

        return (new UserResource($data))->additional([
            'success' => true,
            'message' => 'User created successfully',
        ]);
    }

    /**
     * Display the specified User resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->userService->show($id);

        return UserResource::collection($data)->additional([
            'success' => true,
            'message' => 'User records fetched successfully',
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
        $validated = $request->validated();
        
        if (empty($validated['password'])) {
            unset($validated['password']);
        }
        
        $data = $this->userService->update($validated, $id);

        return (new UserResource($data))->additional([
            'success' => true,
            'message' => 'User updated successfully',
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
