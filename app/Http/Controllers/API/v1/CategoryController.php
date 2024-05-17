<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $service;
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function show(Category $category)
    {
        return $this->service->show($category);
    }

    public function edit(Category $category)
    {
        return $this->service->edit($category);
    }

    public function store(CategoryRequest $request)
    {
        return $this->service->store($request->validated());
    }

    public function update(CategoryRequest $request, Category $category)
    {
        return $this->service->update($category, $request->validated());
    }

    public function destroy(Category $category)
    {
        return $this->service->destroy($category);
    }
}
