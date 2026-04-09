<?php

namespace App\DTOs\Accounting;

/**
 * Class ApArDTO
 *
 * Data Transfer Object for ApAr.
 */
class ApArDTO
{
    /**
     * ApArDTO constructor.
     *
     * @param array $data
     */
    public function __construct(
        public readonly array $data = []
    ) {
    }

    /**
     * Create DTO instance from array.
     *
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            data: $data
        );
    }

    /**
     * Convert DTO to array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'data' => $this->data,
        ];
    }

    /**
     * Get a specific value from DTO data.
     *
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->data[$key] ?? $default;
    }

    /**
     * Check if a key exists in DTO data.
     *
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }
}
