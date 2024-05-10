<?php

namespace App\Services;

use App\Repositories\TaskRepository;

final class TaskService extends CrudService
{
    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }
}
