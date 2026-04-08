<?php

namespace App\Http\Controllers\Production;

use App\Services\Production\MachineLaborService;
use App\Http\Requests\Production\MachineLaborRequest;
use App\Http\Resources\Production\MachineLaborResource;
use App\Http\Controllers\Controller;

/**
 * Class MachineLaborController
 *
 * Controller for managing MachineLabor resources.
 * Provides CRUD operations with JSON responses.
 */
class MachineLaborController extends Controller
{
    /**
     * @var MachineLaborService
     */
    protected $machineLaborService;

    /**
     * MachineLaborController constructor.
     *
     * @param MachineLaborService $machineLaborService
     */
    public function __construct(MachineLaborService $machineLaborService)
    {
        $this->machineLaborService = $machineLaborService;
    }

    /**
     * Display all MachineLabor records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->machineLaborService->all();

        return response()->json([
            "success" => true,
            "message" => "All MachineLabor records fetched successfully",
            "data" => MachineLaborResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of MachineLabor resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->machineLaborService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "MachineLabor records fetched successfully",
            "data" => MachineLaborResource::collection($data)
        ]);
    }

    /**
     * Store a newly created MachineLabor resource in storage.
     *
     * @param MachineLaborRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MachineLaborRequest $request)
    {
        $data = $this->machineLaborService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "MachineLabor record created successfully",
            "data" => new MachineLaborResource($data)
        ], 201);
    }

    /**
     * Display the specified MachineLabor resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->machineLaborService->show($id);

        return response()->json([
            "success" => true,
            "message" => "MachineLabor record fetched successfully",
            "data" => new MachineLaborResource($data)
        ]);
    }

    /**
     * Update the specified MachineLabor resource in storage.
     *
     * @param MachineLaborRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MachineLaborRequest $request, $id)
    {
        $data = $this->machineLaborService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "MachineLabor record updated successfully",
            "data" => new MachineLaborResource($data)
        ]);
    }

    /**
     * Remove the specified MachineLabor resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->machineLaborService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "MachineLabor record deleted successfully"
        ]);
    }
}
