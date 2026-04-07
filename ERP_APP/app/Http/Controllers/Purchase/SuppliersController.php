<?php

namespace App\Http\Controllers\Purchase;

use App\Services\Purchase\SuppliersService;
use App\Http\Requests\Purchase\SuppliersRequest;
use App\Http\Resources\Purchase\SuppliersResource;
use App\Http\Controllers\Controller;

/**
 * Class SuppliersController
 *
 * Controller for managing Suppliers resources.
 * Provides CRUD operations with JSON responses.
 */
class SuppliersController extends Controller
{
    /**
     * @var SuppliersService
     */
    protected $suppliersService;

    /**
     * SuppliersController constructor.
     *
     * @param SuppliersService $suppliersService
     */
    public function __construct(SuppliersService $suppliersService)
    {
        $this->suppliersService = $suppliersService;
    }

    /**
     * Display a paginated listing of Suppliers resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->suppliersService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Suppliers records fetched successfully",
            "data" => SuppliersResource::collection($data)
        ]);
    }

    /**
     * Display all Suppliers records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->suppliersService->all();

        return response()->json([
            "success" => true,
            "message" => "All Suppliers records fetched successfully",
            "data" => SuppliersResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Suppliers resource in storage.
     *
     * @param SuppliersRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SuppliersRequest $request)
    {
        $data = $this->suppliersService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Suppliers record created successfully",
            "data" => new SuppliersResource($data)
        ], 201);
    }

    /**
     * Display the specified Suppliers resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->suppliersService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Suppliers record fetched successfully",
            "data" => new SuppliersResource($data)
        ]);
    }

    /**
     * Update the specified Suppliers resource in storage.
     *
     * @param SuppliersRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SuppliersRequest $request, $id)
    {
        $data = $this->suppliersService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "Suppliers record updated successfully",
            "data" => new SuppliersResource($data)
        ]);
    }

    /**
     * Remove the specified Suppliers resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->suppliersService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Suppliers record deleted successfully"
        ]);
    }
}
