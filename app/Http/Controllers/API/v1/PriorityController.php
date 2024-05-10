<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\PriorityRequest;
use App\Models\Priority;
use App\Services\PriorityService;

class PriorityController extends Controller
{
    protected $service;
    public function __construct(PriorityService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function show(Priority $priority)
    {
        return $this->service->show($priority);
    }

    public function edit(Priority $priority)
    {
        return $this->service->edit($priority);
    }

    public function store(PriorityRequest $request)
    {
        return $this->service->store($request->validated());
    }

    public function update(PriorityRequest $request, Priority $priority)
    {
        return $this->service->update($priority, $request->validated());
    }

    public function destroy(Priority $priority)
    {
        return $this->service->destroy($priority);
    }
}
