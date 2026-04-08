<?php

namespace App\Http\Controllers\HR;

use App\Services\HR\EmployeesService;
use App\Http\Requests\HR\EmployeesRequest;
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
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
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
     * @param EmployeesRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EmployeesRequest $request)
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
     * @return \Illuminate\Http\JsonResponse
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
     * @param EmployeesRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EmployeesRequest $request, $id)
    {
        $data = $this->employeesService->update($id, $request->validated());

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
     * @return \Illuminate\Http\JsonResponse
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
