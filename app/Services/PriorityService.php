<?php

namespace App\Services;

use App\Repositories\PriorityRepository;

final class PriorityService extends CrudService
{
    public function __construct(PriorityRepository $repository)
    {
        $this->repository = $repository;
    }
}
