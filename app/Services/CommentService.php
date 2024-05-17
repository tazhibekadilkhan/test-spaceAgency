<?php

namespace App\Services;

use App\Repositories\CommentRepository;

final class CommentService extends CrudService
{
    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }
}
