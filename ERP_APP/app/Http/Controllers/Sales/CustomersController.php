<?php

namespace App\Http\Controllers\Sales;

use App\Services\Sales\CustomersService;
use App\Http\Requests\Sales\CustomersStoreRequest;
use App\Http\Requests\Sales\CustomersUpdateRequest;
use App\Http\Resources\Sales\CustomersResource;
use App\Http\Controllers\Controller;

/**
 * Class CustomersController
 *
 * Controller for managing Customers resources.
 * Provides CRUD operations with JSON responses.
 */
class CustomersController extends Controller
{
    /**
     * @var CustomersService
     */
    protected $customersService;

    /**
     * CustomersController constructor.
     *
     * @param CustomersService $customersService
     */
    public function __construct(CustomersService $customersService)
    {
        $this->customersService = $customersService;
    }

    /**
     * Display all Customers records without pagination.
     *
     */
    public function all()
    {
        $data = $this->customersService->all();

        return response()->json([
            "success" => true,
            "message" => "All Customers records fetched successfully",
            "data" => CustomersResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of Customers resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->customersService->index($perPage, $search, $filters);

        if (request()->ajax()) {
            return response()->json([
                "success" => true,
                "message" => "Customers records fetched successfully",
                "data" => CustomersResource::collection($data)
            ]);
        }

        return view("sales.customers", compact("data"));
    }

    /**
     * Store a newly created Customers resource in storage.
     *
     * @param CustomersStoreRequest $request
     */
    public function store(CustomersStoreRequest $request)
    {
        $data = $this->customersService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Customers record created successfully",
            "data" => new CustomersResource($data)
        ], 201);
    }

    /**
     * Display the specified Customers resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->customersService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Customers record fetched successfully",
            "data" => new CustomersResource($data)
        ]);
    }

    /**
     * Update the specified Customers resource in storage.
     *
     * @param CustomersUpdateRequest $request
     * @param int $id
     */
    public function update(CustomersUpdateRequest $request, $id)
    {
        $data = $this->customersService->update($request->validated(), $id);

        return response()->json([
            "success" => true,
            "message" => "Customers record updated successfully",
            "data" => new CustomersResource($data)
        ]);
    }

    /**
     * Remove the specified Customers resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->customersService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Customers record deleted successfully"
        ]);
    }
}
