<?php

namespace App\Http\Controllers\Inventory;

use App\Services\Inventory\ProductCatalogService;
use App\Http\Requests\Inventory\ProductCatalogStoreRequest;
use App\Http\Requests\Inventory\ProductCatalogUpdateRequest;
use App\Http\Resources\Inventory\ProductCatalogResource;
use App\Http\Controllers\Controller;

/**
 * Class ProductCatalogController
 *
 * Controller for managing ProductCatalog resources.
 * Provides CRUD operations with JSON responses.
 */
class ProductCatalogController extends Controller
{
    /**
     * @var ProductCatalogService
     */
    protected $productCatalogService;

    /**
     * ProductCatalogController constructor.
     *
     * @param ProductCatalogService $productCatalogService
     */
    public function __construct(ProductCatalogService $productCatalogService)
    {
        $this->productCatalogService = $productCatalogService;
    }

    /**
     * Display all ProductCatalog records without pagination.
     *
     */
    public function all()
    {
        $data = $this->productCatalogService->all();

        return ProductCatalogResource::collection($data)->additional(['success' => true, 'message' => 'All ProductCatalog records fetched successfully']);
    }

    /**
     * Display a paginated listing of ProductCatalog resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->productCatalogService->index($perPage, $search, $filters);

        return view("inventory.product_catalog", compact("data"));
    }

    /**
     * Store a newly created ProductCatalog resource in storage.
     *
     * @param ProductCatalogStoreRequest $request
     */
    public function store(ProductCatalogStoreRequest $request)
    {
        $data = $this->productCatalogService->store($request->validated());

        return (new ProductCatalogResource($data))->additional(['success' => true, 'message' => 'ProductCatalog record created successfully']);
    }

    /**
     * Display the specified ProductCatalog resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->productCatalogService->show($id);

        return (new ProductCatalogResource($data))->additional(['success' => true, 'message' => 'ProductCatalog record fetched successfully']);
    }

    /**
     * Update the specified ProductCatalog resource in storage.
     *
     * @param ProductCatalogUpdateRequest $request
     * @param int $id
     */
    public function update(ProductCatalogUpdateRequest $request, $id)
    {
        $data = $this->productCatalogService->update($request->validated(), $id);

        return (new ProductCatalogResource($data))->additional(['success' => true, 'message' => 'ProductCatalog record updated successfully']);
    }

    /**
     * Remove the specified ProductCatalog resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->productCatalogService->destroy($id);

        return response()->json(["success" => true, "message" => "ProductCatalog record deleted successfully"]);
    }
}
