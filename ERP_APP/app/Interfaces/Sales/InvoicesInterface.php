<?php

namespace App\Interfaces\Sales;

interface InvoicesInterface
{
    public function all();

    public function index(int $perPage = 15, string $search = '', array $filters = []);

    public function create(array $data);

    public function read(int $id);

    public function update(int $id, array $data);

    public function delete(int $id);

    public function getByOrder(int $orderId);

    public function updatePaymentStatus(int $id, string $status);
}
