<?php

namespace App\Http\Controllers\CRM;

use App\Services\CRM\InteractionsService;
use App\Http\Requests\CRM\InteractionsStoreRequest;
use App\Http\Requests\CRM\InteractionsUpdateRequest;
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
     */
    public function all()
    {
        $data = $this->interactionsService->all();

        return InteractionsResource::collection($data)->additional([
            "success" => true,
            "message" => "All Interactions records fetched successfully"
        ]);
    }

    /**
     * Display a paginated listing of Interactions resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->interactionsService->index($perPage, $search, $filters);

        return view("crm.interactions", compact("data"));
    }

    /**
     * Store a newly created Interactions resource in storage.
     *
     * @param InteractionsStoreRequest $request
     */
    public function store(InteractionsStoreRequest $request)
    {
        $data = $this->interactionsService->store($request->validated());

        return (new InteractionsResource($data))->additional([
            "success" => true,
            "message" => "Interactions record created successfully"
        ]);
    }

    /**
     * Display the specified Interactions resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->interactionsService->show($id);

        return (new InteractionsResource($data))->additional([
            "success" => true,
            "message" => "Interactions record fetched successfully"
        ]);
    }

    /**
     * Update the specified Interactions resource in storage.
     *
     * @param InteractionsUpdateRequest $request
     * @param int $id
     */
    public function update(InteractionsUpdateRequest $request, $id)
    {
        $data = $this->interactionsService->update($request->validated(), $id);

        return (new InteractionsResource($data))->additional([
            "success" => true,
            "message" => "Interactions record updated successfully"
        ]);
    }

    /**
     * Remove the specified Interactions resource from storage.
     *
     * @param int $id
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
