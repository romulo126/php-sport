<?php

namespace App\Repositories\Traits\Contracts;

use Illuminate\Database\Eloquent\Model;

interface HasRepositoryMethodsContract
{
    public function getModel(): Model;

    public function getById(int $id): ?Model;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}