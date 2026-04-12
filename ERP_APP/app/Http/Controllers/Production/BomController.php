<?php

namespace App\Http\Controllers\Production;

use App\Services\Production\BomService;
use App\Http\Requests\Production\BomStoreRequest;
use App\Http\Requests\Production\BomUpdateRequest;
use App\Http\Resources\Production\BomResource;
use App\Http\Controllers\Controller;

/**
 * Class BomController
 *
 * Controller for managing Bom resources.
 * Provides CRUD operations with JSON responses.
 */
class BomController extends Controller
{
    /**
     * @var BomService
     */
    protected $bomService;

    /**
     * BomController constructor.
     *
     * @param BomService $bomService
     */
    public function __construct(BomService $bomService)
    {
        $this->bomService = $bomService;
    }

    /**
     * Display all Bom records without pagination.
     *
     */
    public function all()
    {
        $data = $this->bomService->all();

        return response()->json([
            "success" => true,
            "message" => "All Bom records fetched successfully",
            "data" => BomResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of Bom resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->bomService->index($perPage, $search, $filters);

        if (request()->ajax()) {
            return response()->json([
                "success" => true,
                "message" => "Bom records fetched successfully",
                "data" => BomResource::collection($data)
            ]);
        }

        return view("production.bom", compact("data"));
    }

    /**
     * Store a newly created Bom resource in storage.
     *
     * @param BomStoreRequest $request
     */
    public function store(BomStoreRequest $request)
    {
        $data = $this->bomService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Bom record created successfully",
            "data" => new BomResource($data)
        ], 201);
    }

    /**
     * Display the specified Bom resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->bomService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Bom record fetched successfully",
            "data" => new BomResource($data)
        ]);
    }

    /**
     * Update the specified Bom resource in storage.
     *
     * @param BomUpdateRequest $request
     * @param int $id
     */
    public function update(BomUpdateRequest $request, $id)
    {
        $data = $this->bomService->update($request->validated(), $id);

        return response()->json([
            "success" => true,
            "message" => "Bom record updated successfully",
            "data" => new BomResource($data)
        ]);
    }

    /**
     * Remove the specified Bom resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->bomService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Bom record deleted successfully"
        ]);
    }
}
