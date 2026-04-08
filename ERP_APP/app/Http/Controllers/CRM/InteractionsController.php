<?php

namespace App\Http\Controllers\CRM;

use App\Services\CRM\InteractionsService;
use App\Http\Requests\CRM\InteractionsRequest;
use App\Http\Resources\CRM\InteractionsResource;
use App\Http\Controllers\Controller;

/**
 * Class InteractionsController
 *
 * Controller for managing Interactions resources.
 * Provides CRUD operations with JSON responses.
 */
class InteractionsController extends Controller
{
    /**
     * @var InteractionsService
     */
    protected $interactionsService;

    /**
     * InteractionsController constructor.
     *
     * @param InteractionsService $interactionsService
     */
    public function __construct(InteractionsService $interactionsService)
    {
        $this->interactionsService = $interactionsService;
    }

    /**
     * Display all Interactions records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->interactionsService->all();

        return response()->json([
            "success" => true,
            "message" => "All Interactions records fetched successfully",
            "data" => InteractionsResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of Interactions resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->interactionsService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Interactions records fetched successfully",
            "data" => InteractionsResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Interactions resource in storage.
     *
     * @param InteractionsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(InteractionsRequest $request)
    {
        $data = $this->interactionsService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Interactions record created successfully",
            "data" => new InteractionsResource($data)
        ], 201);
    }

    /**
     * Display the specified Interactions resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->interactionsService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Interactions record fetched successfully",
            "data" => new InteractionsResource($data)
        ]);
    }

    /**
     * Update the specified Interactions resource in storage.
     *
     * @param InteractionsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(InteractionsRequest $request, $id)
    {
        $data = $this->interactionsService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "Interactions record updated successfully",
            "data" => new InteractionsResource($data)
        ]);
    }

    /**
     * Remove the specified Interactions resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->interactionsService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Interactions record deleted successfully"
        ]);
    }
}
