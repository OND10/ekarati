<?php

namespace Modules\CommonService\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface GenericRepositoryInterface
{
    public function getAll(): Collection;
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
