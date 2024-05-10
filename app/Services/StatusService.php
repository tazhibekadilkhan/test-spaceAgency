<?php

namespace App\Services;

use App\Repositories\StatusRepository;

final class StatusService extends CrudService
{
    public function __construct(StatusRepository $repository)
    {
        $this->repository = $repository;
    }
}
