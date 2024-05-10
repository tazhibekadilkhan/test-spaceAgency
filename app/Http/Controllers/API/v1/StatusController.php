<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StatusRequest;
use App\Models\Status;
use App\Services\StatusService;

class StatusController extends Controller
{
    protected $service;
    public function __construct(StatusService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function show(Status $status)
    {
        return $this->service->show($status);
    }

    public function edit(Status $status)
    {
        return $this->service->edit($status);
    }

    public function store(StatusRequest $request)
    {
        return $this->service->store($request->validated());
    }

    public function update(StatusRequest $request, Status $status)
    {
        return $this->service->update($status, $request->validated());
    }

    public function destroy(Status $status)
    {
        return $this->service->destroy($status);
    }
}
