<?php

namespace App\Interfaces\UsersRoles;

interface UsersInterface
{
    public function all();

    public function index(string $search = '', array $filters = []);

    public function create($data);

    public function read($id);

    public function update($id, $data);

    public function delete($id);
}
