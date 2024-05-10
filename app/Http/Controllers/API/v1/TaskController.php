<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\TaskRequest;
use App\Models\Task;
use App\Services\TaskService;

class TaskController extends Controller
{
    protected $service;
    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function show(Task $task)
    {
        return $this->service->show($task);
    }

    public function edit(Task $task)
    {
        return $this->service->edit($task);
    }

    public function store(TaskRequest $request)
    {
        return $this->service->store($request->validated());
    }

    public function update(TaskRequest $request, Task $task)
    {
        return $this->service->update($task, $request->validated());
    }

    public function destroy(Task $task)
    {
        return $this->service->destroy($task);
    }
}
