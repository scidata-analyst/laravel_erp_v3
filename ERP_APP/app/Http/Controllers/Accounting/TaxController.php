<?php

namespace App\Http\Controllers\Accounting;

use App\Services\Accounting\TaxService;
use App\Http\Requests\Accounting\TaxStoreRequest;
use App\Http\Requests\Accounting\TaxUpdateRequest;
use App\Http\Resources\Accounting\TaxResource;
use App\Http\Controllers\Controller;

/**
 * Class TaxController
 *
 * Controller for managing Tax resources.
 * Provides CRUD operations with JSON responses.
 */
class TaxController extends Controller
{
    /**
     * @var TaxService
     */
    protected $taxService;

    /**
     * TaxController constructor.
     *
     * @param TaxService $taxService
     */
    public function __construct(TaxService $taxService)
    {
        $this->taxService = $taxService;
    }

    /**
     * Display all Tax records without pagination.
     *
     */
    public function all()
    {
        $data = $this->taxService->all();

        return TaxResource::collection($data)->additional([
            'success' => true,
            'message' => 'All Tax records fetched successfully',
        ]);
    }

    /**
     * Display a paginated listing of Tax resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->taxService->index($perPage, $search, $filters);

        return view("accounting.tax", compact("data"));
    }

    /**
     * Store a newly created Tax resource in storage.
     *
     * @param TaxStoreRequest $request
     */
    public function store(TaxStoreRequest $request)
    {
        $data = $this->taxService->store($request->validated());

        return (new TaxResource($data))->additional([
            'success' => true,
            'message' => 'Tax record created successfully',
        ]);
    }

    /**
     * Display the specified Tax resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->taxService->show($id);

        return (new TaxResource($data))->additional([
            'success' => true,
            'message' => 'Tax record fetched successfully',
        ]);
    }

    /**
     * Update the specified Tax resource in storage.
     *
     * @param TaxUpdateRequest $request
     * @param int $id
     */
    public function update(TaxUpdateRequest $request, $id)
    {
        $data = $this->taxService->update($request->validated(), $id);

        return (new TaxResource($data))->additional([
            'success' => true,
            'message' => 'Tax record updated successfully',
        ]);
    }

    /**
     * Remove the specified Tax resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->taxService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Tax record deleted successfully"
        ]);
    }
}
