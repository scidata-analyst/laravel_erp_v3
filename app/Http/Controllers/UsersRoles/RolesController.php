<?php

namespace App\Http\Controllers\UsersRoles;

use App\Services\UsersRoles\RolesService;
use App\Http\Requests\UsersRoles\RolesStoreRequest;
use App\Http\Requests\UsersRoles\RolesUpdateRequest;
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
     */
    public function all()
    {
        $data = $this->rolesService->all();

        return RolesResource::collection($data)->additional([
            "success" => true,
            "message" => "All Roles records fetched successfully"
        ]);
    }

    /**
     * Display a paginated listing of Roles resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->rolesService->index($perPage, $search, $filters);

        return view("users_roles.roles", compact("data"));
    }

    /**
     * Store a newly created Roles resource in storage.
     *
     * @param RolesStoreRequest $request
     */
    public function store(RolesStoreRequest $request)
    {
        $data = $this->rolesService->store($request->validated());

        return (new RolesResource($data))->additional([
            "success" => true,
            "message" => "Roles record created successfully"
        ]);
    }

    /**
     * Display the specified Roles resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->rolesService->show($id);

        return (new RolesResource($data))->additional([
            "success" => true,
            "message" => "Roles record fetched successfully"
        ]);
    }

    /**
     * Update the specified Roles resource in storage.
     *
     * @param RolesUpdateRequest $request
     * @param int $id
     */
    public function update(RolesUpdateRequest $request, $id)
    {
        $data = $this->rolesService->update($request->validated(), $id);

        return (new RolesResource($data))->additional([
            "success" => true,
            "message" => "Roles record updated successfully"
        ]);
    }

    /**
     * Remove the specified Roles resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->rolesService->destroy($id);

        return response()->json(["success" => true, "message" => "Roles record deleted successfully"]);
    }
}
