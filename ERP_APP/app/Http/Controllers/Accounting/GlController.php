<?php

namespace App\Http\Controllers\Accounting;

use App\Services\Accounting\GlService;
use App\Http\Requests\Accounting\GlStoreRequest;
use App\Http\Requests\Accounting\GlUpdateRequest;
use App\Http\Resources\Accounting\GlResource;
use App\Http\Controllers\Controller;

/**
 * Class GlController
 *
 * Controller for managing Gl resources.
 * Provides CRUD operations with JSON responses.
 */
class GlController extends Controller
{
    /**
     * @var GlService
     */
    protected $glService;

    /**
     * GlController constructor.
     *
     * @param GlService $glService
     */
    public function __construct(GlService $glService)
    {
        $this->glService = $glService;
    }

    /**
     * Display all Gl records without pagination.
     *
     */
    public function all()
    {
        $data = $this->glService->all();

        return response()->json([
            "success" => true,
            "message" => "All Gl records fetched successfully",
            "data" => GlResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of Gl resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->glService->index($perPage, $search, $filters);

        if (request()->ajax()) {
            return response()->json([
                "success" => true,
                "message" => "Gl records fetched successfully",
                "data" => GlResource::collection($data)
            ]);
        }

        return view("accounting.gl", compact("data"));
    }

    /**
     * Store a newly created Gl resource in storage.
     *
     * @param GlStoreRequest $request
     */
    public function store(GlStoreRequest $request)
    {
        $data = $this->glService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Gl record created successfully",
            "data" => new GlResource($data)
        ], 201);
    }

    /**
     * Display the specified Gl resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->glService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Gl record fetched successfully",
            "data" => new GlResource($data)
        ]);
    }

    /**
     * Update the specified Gl resource in storage.
     *
     * @param GlUpdateRequest $request
     * @param int $id
     */
    public function update(GlUpdateRequest $request, $id)
    {
        $data = $this->glService->update($request->validated(), $id);

        return response()->json([
            "success" => true,
            "message" => "Gl record updated successfully",
            "data" => new GlResource($data)
        ]);
    }

    /**
     * Remove the specified Gl resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->glService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Gl record deleted successfully"
        ]);
    }
}
