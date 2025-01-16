<?php

namespace App\Repositories\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasRepositoryMethods
{
    public function getById(int $id, array $with = []): ?Model
    {
        if (! empty($with)) {
            return $this->model->with($with)->find($id);
        }
        
        return $this->model->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $record = $this->model->find($id);

        if (!$record) {
            return false;
        }

        return $record->update($data);
    }

    public function delete(int $id): ?bool
    {
        $record = $this->model->find($id);

        if (! $record) {
            return false;
        }

        return $record->delete();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }
}