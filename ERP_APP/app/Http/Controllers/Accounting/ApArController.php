<?php

namespace App\Http\Controllers\Accounting;

use App\Services\Accounting\ApArService;
use App\Http\Requests\Accounting\ApArStoreRequest;
use App\Http\Requests\Accounting\ApArUpdateRequest;
use App\Http\Resources\Accounting\ApArResource;
use App\Http\Controllers\Controller;

/**
 * Class ApArController
 *
 * Controller for managing ApAr resources.
 * Provides CRUD operations with JSON responses.
 */
class ApArController extends Controller
{
    /**
     * @var ApArService
     */
    protected $apArService;

    /**
     * ApArController constructor.
     *
     * @param ApArService $apArService
     */
    public function __construct(ApArService $apArService)
    {
        $this->apArService = $apArService;
    }

    /**
     * Display all ApAr records without pagination.
     *
     */
    public function all()
    {
        $data = $this->apArService->all();

        return response()->json([
            "success" => true,
            "message" => "All ApAr records fetched successfully",
            "data" => ApArResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of ApAr resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->apArService->index($perPage, $search, $filters);

        if (request()->ajax()) {
            return response()->json([
                "success" => true,
                "message" => "ApAr records fetched successfully",
                "data" => ApArResource::collection($data)
            ]);
        }

        return view("accounting.ap_ar", compact("data"));
    }

    /**
     * Store a newly created ApAr resource in storage.
     *
     * @param ApArStoreRequest $request
     */
    public function store(ApArStoreRequest $request)
    {
        $data = $this->apArService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "ApAr record created successfully",
            "data" => new ApArResource($data)
        ], 201);
    }

    /**
     * Display the specified ApAr resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->apArService->show($id);

        return response()->json([
            "success" => true,
            "message" => "ApAr record fetched successfully",
            "data" => new ApArResource($data)
        ]);
    }

    /**
     * Update the specified ApAr resource in storage.
     *
     * @param ApArUpdateRequest $request
     * @param int $id
     */
    public function update(ApArUpdateRequest $request, $id)
    {
        $data = $this->apArService->update($request->validated(), $id);

        return response()->json([
            "success" => true,
            "message" => "ApAr record updated successfully",
            "data" => new ApArResource($data)
        ]);
    }

    /**
     * Remove the specified ApAr resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->apArService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "ApAr record deleted successfully"
        ]);
    }
}
