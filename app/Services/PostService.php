<?php

namespace App\Services;

use App\Repositories\PostRepository;

final class PostService extends CrudService
{
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }
}
