<?php

namespace App\DTOs\Production;

class BomDTO
{
    public function __construct(
        public readonly ?string $bom_number = null,
        public readonly ?string $finished_product = null,
        public readonly ?string $version = null,
        public readonly ?string $status = null,
        public readonly array $components = [],
        public readonly ?string $notes = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        $components = $data['components'] ?? [];
        if ($components === []) {
            $firstComponent = [
                'name' => $data['components[0][name]'] ?? null,
                'qty' => isset($data['components[0][qty]']) ? (float) $data['components[0][qty]'] : null,
                'unit' => $data['components[0][unit]'] ?? null,
                'cost' => isset($data['components[0][cost]']) ? (float) $data['components[0][cost]'] : null,
            ];

            if (array_filter($firstComponent, static fn ($value) => $value !== null && $value !== '')) {
                $components = [$firstComponent];
            }
        }

        return new self(
            bom_number: $data['bom_number'] ?? null,
            finished_product: $data['finished_product'] ?? $data['name'] ?? (isset($data['product_id']) ? (string) $data['product_id'] : null),
            version: $data['version'] ?? null,
            status: $data['status'] ?? null,
            components: $components,
            notes: $data['notes'] ?? $data['description'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'bom_number' => $this->bom_number,
            'finished_product' => $this->finished_product,
            'version' => $this->version,
            'status' => $this->status,
            'components' => $this->components,
            'notes' => $this->notes,
        ];
    }
}
