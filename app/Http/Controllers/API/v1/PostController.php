<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\PostRequest;
use App\Models\Post;
use App\Services\PostService;

class PostController extends Controller
{
    protected $service;
    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function show(Post $post)
    {
        return $this->service->show($post);
    }

    public function edit(Post $post)
    {
        return $this->service->edit($post);
    }

    public function store(PostRequest $request)
    {
        return $this->service->store($request->validated());
    }

    public function update(PostRequest $request, Post $post)
    {
        return $this->service->update($post, $request->validated());
    }

    public function destroy(Post $post)
    {
        return $this->service->destroy($post);
    }
}
