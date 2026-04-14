<?php

namespace App\Http\Controllers\Purchase;

use App\Services\Purchase\SuppliersService;
use App\Http\Requests\Purchase\SuppliersStoreRequest;
use App\Http\Requests\Purchase\SuppliersUpdateRequest;
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
     * Display all Suppliers records without pagination.
     *
     */
    public function all()
    {
        $data = $this->suppliersService->all();

        return SuppliersResource::collection($data)
            ->additional([
                'success' => true,
                'message' => 'Suppliers records fetched successfully',
            ]);
    }

    /**
     * Display a paginated listing of Suppliers resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->suppliersService->index($perPage, $search, $filters);

        return view("purchase.suppliers", compact("data"));
    }

    /**
     * Store a newly created Suppliers resource in storage.
     *
     * @param SuppliersStoreRequest $request
     */
    public function store(SuppliersStoreRequest $request)
    {
        $data = $this->suppliersService->store($request->validated());

        return (new SuppliersResource($data))->additional([
            'success' => true,
            'message' => 'Suppliers record created successfully',
        ]);
    }

    /**
     * Display the specified Suppliers resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->suppliersService->show($id);

        return (new SuppliersResource($data))->additional([
            'success' => true,
            'message' => 'Suppliers record fetched successfully',
        ]);
    }

    /**
     * Update the specified Suppliers resource in storage.
     *
     * @param SuppliersUpdateRequest $request
     * @param int $id
     */
    public function update(SuppliersUpdateRequest $request, $id)
    {
        $data = $this->suppliersService->update($request->validated(), $id);

        return (new SuppliersResource($data))->additional([
            'success' => true,
            'message' => 'Suppliers record updated successfully',
        ]);
    }

    /**
     * Remove the specified Suppliers resource from storage.
     *
     * @param int $id
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
