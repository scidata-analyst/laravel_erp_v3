<?php

namespace App\Interfaces\CRM;

interface LeadsInterface
{
    public function all();

    public function index(int $perPage = 15, string $search = '', array $filters = []);

    public function create(array $data);

    public function read(int $id);

    public function update(int $id, array $data);

    public function delete(int $id);

    public function getByStage(string $stage);

    public function convertToCustomer(int $leadId);
}
