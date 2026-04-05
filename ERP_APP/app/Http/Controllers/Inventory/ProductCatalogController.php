<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\ProductCatalogRequest;
use App\Models\Inventory\ProductCatalog;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\Inventory\ProductCatalogService;
use App\Http\Resources\Inventory\ProductCatalogResource;
use App\DTOs\Inventory\ProductCatalogDTO;

class ProductCatalogController extends Controller
{
    public function __construct(
        protected ProductCatalogService $service
    ) {}

    public function index(ProductCatalogRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $products = $this->service->getPaginatedProducts($perPage, $search, $filters);

        return ProductCatalogResource::collection($products)
            ->additional([
                'success' => true,
                'message' => 'Products retrieved successfully'
            ]);
    }

    public function store(ProductCatalogRequest $request): JsonResponse
    {
        $dto = ProductCatalogDTO::fromRequest($request->validated());
        $product = $this->service->createProduct($dto);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => new ProductCatalogResource($product)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $product = $this->service->getProductById($id);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product retrieved successfully',
            'data' => new ProductCatalogResource($product)
        ]);
    }

    public function update(ProductCatalogRequest $request, int $id): JsonResponse
    {
        $dto = ProductCatalogDTO::fromRequest($request->validated());
        $success = $this->service->updateProduct($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully'
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->deleteProduct($id);

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }

    public function getLowStockProducts(): JsonResponse
    {
        $lowStockProducts = $this->service->getLowStockProducts();

        return response()->json([
            'success' => true,
            'message' => 'Low stock products retrieved successfully',
            'data' => ProductCatalogResource::collection($lowStockProducts),
            'count' => $lowStockProducts->count()
        ]);
    }

    public function getProductStats(): JsonResponse
    {
        $stats = $this->service->getProductStats();

        return response()->json([
            'success' => true,
            'message' => 'Product statistics retrieved successfully',
            'data' => $stats
        ]);
    }
}
