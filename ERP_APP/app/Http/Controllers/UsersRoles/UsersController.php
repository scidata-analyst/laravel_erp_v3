<?php

namespace App\Http\Controllers\UsersRoles;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRoles\UsersRequest;
use App\Http\Resources\Auth\UserResource;
use App\Services\Auth\UserService;
use App\DTOs\Auth\UserDTO;
use App\Traits\Http\ApiResponse;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected UserService $service
    ) {}

    public function index(UsersRequest $request): JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $users = $this->service->getUsers($perPage, $search, $filters);

        return $this->successResponse(
            UserResource::collection($users)->response()->getData(true),
            'Users retrieved successfully'
        );
    }

    public function store(UsersRequest $request): JsonResponse
    {
        $dto = UserDTO::fromRequest($request->validated());
        $user = $this->service->registerUser($dto);

        return $this->successResponse(
            new UserResource($user),
            'User created successfully',
            201
        );
    }

    public function show(int $id): JsonResponse
    {
        $user = $this->service->getUserById($id);

        if (!$user) {
            return $this->errorResponse('User not found', 404);
        }

        return $this->successResponse(
            new UserResource($user),
            'User retrieved successfully'
        );
    }

    public function update(UsersRequest $request, int $id): JsonResponse
    {
        $dto = UserDTO::fromRequest($request->validated());
        $success = $this->service->updateUser($id, $dto);

        if (!$success) {
            return $this->errorResponse('User not found', 404);
        }

        return $this->successResponse(
            new UserResource($this->service->getUserById($id)),
            'User updated successfully'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteUser($id);

        if (!$success) {
            return $this->errorResponse('User not found', 404);
        }

        return $this->successResponse(null, 'User deleted successfully');
    }
}
