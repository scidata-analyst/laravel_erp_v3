<?php

namespace App\Http\Controllers\Sales;

use App\Services\Sales\PromotionsService;
use App\Http\Requests\Sales\PromotionsStoreRequest;
use App\Http\Requests\Sales\PromotionsUpdateRequest;
use App\Http\Resources\Sales\PromotionsResource;
use App\Http\Controllers\Controller;

/**
 * Class PromotionsController
 *
 * Controller for managing Promotions resources.
 * Provides CRUD operations with JSON responses.
 */
class PromotionsController extends Controller
{
    /**
     * @var PromotionsService
     */
    protected $promotionsService;

    /**
     * PromotionsController constructor.
     *
     * @param PromotionsService $promotionsService
     */
    public function __construct(PromotionsService $promotionsService)
    {
        $this->promotionsService = $promotionsService;
    }

    /**
     * Display all Promotions records without pagination.
     *
     */
    public function all()
    {
        $data = $this->promotionsService->all();

        return response()->json([
            "success" => true,
            "message" => "All Promotions records fetched successfully",
            "data" => PromotionsResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of Promotions resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->promotionsService->index($perPage, $search, $filters);

        if (request()->ajax()) {
            return response()->json([
                "success" => true,
                "message" => "Promotions records fetched successfully",
                "data" => PromotionsResource::collection($data)
            ]);
        }

        return view("sales.promotions", compact("data"));
    }

    /**
     * Store a newly created Promotions resource in storage.
     *
     * @param PromotionsStoreRequest $request
     */
    public function store(PromotionsStoreRequest $request)
    {
        $data = $this->promotionsService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Promotions record created successfully",
            "data" => new PromotionsResource($data)
        ], 201);
    }

    /**
     * Display the specified Promotions resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->promotionsService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Promotions record fetched successfully",
            "data" => new PromotionsResource($data)
        ]);
    }

    /**
     * Update the specified Promotions resource in storage.
     *
     * @param PromotionsUpdateRequest $request
     * @param int $id
     */
    public function update(PromotionsUpdateRequest $request, $id)
    {
        $data = $this->promotionsService->update($request->validated(), $id);

        return response()->json([
            "success" => true,
            "message" => "Promotions record updated successfully",
            "data" => new PromotionsResource($data)
        ]);
    }

    /**
     * Remove the specified Promotions resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->promotionsService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Promotions record deleted successfully"
        ]);
    }
}
