<?php


namespace App\Repositories;


use App\Models\Priority;

class PriorityRepository extends BaseRepository
{
    public function __construct(Priority $model)
    {
        $this->model = $model;
    }
}
