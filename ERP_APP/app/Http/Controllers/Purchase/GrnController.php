<?php

namespace App\Http\Controllers\Purchase;

use App\Services\Purchase\GrnService;
use App\Http\Requests\Purchase\GrnStoreRequest;
use App\Http\Requests\Purchase\GrnUpdateRequest;
use App\Http\Resources\Purchase\GrnResource;
use App\Http\Controllers\Controller;

/**
 * Class GrnController
 *
 * Controller for managing Grn resources.
 * Provides CRUD operations with JSON responses.
 */
class GrnController extends Controller
{
    /**
     * @var GrnService
     */
    protected $grnService;

    /**
     * GrnController constructor.
     *
     * @param GrnService $grnService
     */
    public function __construct(GrnService $grnService)
    {
        $this->grnService = $grnService;
    }

    /**
     * Display all Grn records without pagination.
     *
     */
    public function all()
    {
        $data = $this->grnService->all();

        return GrnResource::collection($data)
            ->additional([
                'success' => true,
                'message' => 'Grn records fetched successfully',
            ]);
    }

    /**
     * Display a paginated listing of Grn resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->grnService->index($perPage, $search, $filters);

        return view("purchase.grn", compact("data"));
    }

    /**
     * Store a newly created Grn resource in storage.
     *
     * @param GrnStoreRequest $request
     */
    public function store(GrnStoreRequest $request)
    {
        $data = $this->grnService->store($request->validated());

        return (new GrnResource($data))->additional([
            'success' => true,
            'message' => 'Grn record created successfully',
        ]);
    }

    /**
     * Display the specified Grn resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->grnService->show($id);

        return (new GrnResource($data))->additional([
            'success' => true,
            'message' => 'Grn record fetched successfully',
        ]);
    }

    /**
     * Update the specified Grn resource in storage.
     *
     * @param GrnUpdateRequest $request
     * @param int $id
     */
    public function update(GrnUpdateRequest $request, $id)
    {
        $data = $this->grnService->update($request->validated(), $id);

        return (new GrnResource($data))->additional([
            'success' => true,
            'message' => 'Grn record updated successfully',
        ]);
    }

    /**
     * Remove the specified Grn resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->grnService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Grn record deleted successfully"
        ]);
    }
}
