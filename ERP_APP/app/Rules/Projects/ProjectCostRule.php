<?php

namespace App\Rules\Projects;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProjectCostRule implements ValidationRule
{
    public function commonRules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function allRules(): array
    {
        return $this->commonRules();
    }

    public function indexRules(): array
    {
        return array_merge($this->commonRules(), [
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:1'],
            'search' => ['nullable', 'string', 'max:255'],
        ]);
    }

    public function createRules(): array
    {
        return array_merge($this->commonRules(), [
            'name' => ['required', 'string', 'max:255'],
        ]);
    }

    public function readRules(): array
    {
        return [
            'id' => ['required', 'integer', 'min:1'],
        ];
    }

    public function updateRules(): array
    {
        return array_merge($this->readRules(), [
            'name' => ['sometimes', 'string', 'max:255'],
            'status' => ['sometimes', 'string', 'max:50'],
        ]);
    }

    public function deleteRules(): array
    {
        return $this->readRules();
    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
}
