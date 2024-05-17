<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

final class CategoryService extends CrudService
{
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }
}
