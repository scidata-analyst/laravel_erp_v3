<?php

namespace App\Http\Controllers\UsersRoles;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRoles\RolesRequest;
use App\Http\Resources\Auth\RolesResource;
use App\Services\Auth\RolesService;
use App\DTOs\Auth\RolesDTO;
use App\Traits\Http\ApiResponse;
use Illuminate\Http\JsonResponse;

class RolesController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected RolesService $service
    ) {}

    public function index(RolesRequest $request): JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $roles = $this->service->getRoles($perPage, $search, $filters);

        return $this->successResponse(
            RolesResource::collection($roles)->response()->getData(true),
            'Roles retrieved successfully'
        );
    }

    public function store(RolesRequest $request): JsonResponse
    {
        $dto = RolesDTO::fromRequest($request->validated());
        $role = $this->service->createRole($dto);

        return $this->successResponse(
            new RolesResource($role),
            'Role created successfully',
            201
        );
    }

    public function show(int $id): JsonResponse
    {
        $role = $this->service->getRoleById($id);

        if (!$role) {
            return $this->errorResponse('Role not found', 404);
        }

        return $this->successResponse(
            new RolesResource($role),
            'Role retrieved successfully'
        );
    }

    public function update(RolesRequest $request, int $id): JsonResponse
    {
        $dto = RolesDTO::fromRequest($request->validated());
        $success = $this->service->updateRole($id, $dto);

        if (!$success) {
            return $this->errorResponse('Role not found', 404);
        }

        return $this->successResponse(
            new RolesResource($this->service->getRoleById($id)),
            'Role updated successfully'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteRole($id);

        if (!$success) {
            return $this->errorResponse('Role not found', 404);
        }

        return $this->successResponse(null, 'Role deleted successfully');
    }
}
