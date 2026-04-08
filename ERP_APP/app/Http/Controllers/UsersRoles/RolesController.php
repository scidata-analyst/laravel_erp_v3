<?php

namespace App\Http\Controllers\UsersRoles;

use App\Services\UsersRoles\RolesService;
use App\Http\Requests\UsersRoles\RolesRequest;
use App\Http\Resources\UsersRoles\RolesResource;
use App\Http\Controllers\Controller;

/**
 * Class RolesController
 *
 * Controller for managing Roles resources.
 * Provides CRUD operations with JSON responses.
 */
class RolesController extends Controller
{
    /**
     * @var RolesService
     */
    protected $rolesService;

    /**
     * RolesController constructor.
     *
     * @param RolesService $rolesService
     */
    public function __construct(RolesService $rolesService)
    {
        $this->rolesService = $rolesService;
    }

    /**
     * Display all Roles records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->rolesService->all();

        return response()->json([
            "success" => true,
            "message" => "All Roles records fetched successfully",
            "data" => RolesResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of Roles resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->rolesService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Roles records fetched successfully",
            "data" => RolesResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Roles resource in storage.
     *
     * @param RolesRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RolesRequest $request)
    {
        $data = $this->rolesService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Roles record created successfully",
            "data" => new RolesResource($data)
        ], 201);
    }

    /**
     * Display the specified Roles resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->rolesService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Roles record fetched successfully",
            "data" => new RolesResource($data)
        ]);
    }

    /**
     * Update the specified Roles resource in storage.
     *
     * @param RolesRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RolesRequest $request, $id)
    {
        $data = $this->rolesService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "Roles record updated successfully",
            "data" => new RolesResource($data)
        ]);
    }

    /**
     * Remove the specified Roles resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->rolesService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Roles record deleted successfully"
        ]);
    }
}
