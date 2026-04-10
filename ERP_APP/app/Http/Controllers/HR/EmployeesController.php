<?php

namespace App\Http\Controllers\HR;

use App\Services\HR\EmployeesService;
use App\Http\Requests\HR\EmployeesStoreRequest;
use App\Http\Requests\HR\EmployeesUpdateRequest;
use App\Http\Resources\HR\EmployeesResource;
use App\Http\Controllers\Controller;

/**
 * Class EmployeesController
 *
 * Controller for managing Employees resources.
 * Provides CRUD operations with JSON responses.
 */
class EmployeesController extends Controller
{
    /**
     * @var EmployeesService
     */
    protected $employeesService;

    /**
     * EmployeesController constructor.
     *
     * @param EmployeesService $employeesService
     */
    public function __construct(EmployeesService $employeesService)
    {
        $this->employeesService = $employeesService;
    }

    /**
     * Display all Employees records without pagination.
     *
     */
    public function all()
    {
        $data = $this->employeesService->all();

        return response()->json([
            "success" => true,
            "message" => "All Employees records fetched successfully",
            "data" => EmployeesResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of Employees resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->employeesService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Employees records fetched successfully",
            "data" => EmployeesResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Employees resource in storage.
     *
     * @param EmployeesStoreRequest $request
     */
    public function store(EmployeesStoreRequest $request)
    {
        $data = $this->employeesService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Employees record created successfully",
            "data" => new EmployeesResource($data)
        ], 201);
    }

    /**
     * Display the specified Employees resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->employeesService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Employees record fetched successfully",
            "data" => new EmployeesResource($data)
        ]);
    }

    /**
     * Update the specified Employees resource in storage.
     *
     * @param EmployeesUpdateRequest $request
     * @param int $id
     */
    public function update(EmployeesUpdateRequest $request, $id)
    {
        $data = $this->employeesService->update($request->validated(), $id);

        return response()->json([
            "success" => true,
            "message" => "Employees record updated successfully",
            "data" => new EmployeesResource($data)
        ]);
    }

    /**
     * Remove the specified Employees resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->employeesService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Employees record deleted successfully"
        ]);
    }
}
