<?php

namespace App\Interfaces\HR;

interface AttendanceInterface
{
    /**
     * Define your interface methods here
     *
     * Example:
     * public function calculateSomething(): mixed;
     */

    public function all();

    public function index($perPage = 15, $search = null, $filters = null, $sortField = null, $sortDirection = null);

    public function store(array $data);

    public function view(int $id);

    public function update(int $id, array $data);

    public function destroy(int $id);
}
