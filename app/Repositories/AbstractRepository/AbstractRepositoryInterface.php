<?php

namespace App\Repositories\AbstractRepository;

use Illuminate\Database\Eloquent\Model;

interface AbstractRepositoryInterface
{
    public function all(int $limit = 0, int $offset = 0);
    public function store(array $request): Model;
    public function findById(int $id): object;
    public function update(int $id, array $set): void;
    public function delete(int $id): bool;
}
