<?php

namespace App\Http\Resources\Inventory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCatalogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_name' => $this->product_name,
            'sku' => $this->sku,
            'category' => $this->category,
            'unit_price' => $this->unit_price,
            'cost_price' => $this->cost_price,
            'warehouse' => $this->warehouse,
            'reorder_level' => $this->reorder_level,
            'valuation_method' => $this->valuation_method,
            'description' => $this->description,
            'status' => $this->status,
            'barcode' => $this->barcode,
            'weight' => $this->weight,
            'dimensions' => $this->dimensions,
            'warehouse_location' => $this->whenLoaded('warehouseLocation', function () {
                return [
                    'id' => $this->warehouseLocation->id,
                    'warehouse_name' => $this->warehouseLocation->warehouse_name,
                    'code' => $this->warehouseLocation->code,
                    'location_address' => $this->warehouseLocation->location_address
                ];
            }),
            'stock_movements_count' => $this->whenLoaded('stockMovements', function () {
                return $this->stockMovements->count();
            }),
            'batch_tracking_count' => $this->whenLoaded('batchTracking', function () {
                return $this->batchTracking->count();
            }),
            'current_stock' => $this->whenLoaded('stockMovements', function () {
                return $this->stockMovements->sum(function ($movement) {
                    return match ($movement->movement_type) {
                        'Stock In' => (int) $movement->quantity,
                        'Stock Out' => -1 * (int) $movement->quantity,
                        default => 0,
                    };
                });
            }),
            'is_low_stock' => false,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
