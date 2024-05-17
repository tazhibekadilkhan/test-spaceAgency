<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\CommentRequest;
use App\Models\Comment;
use App\Services\CommentService;

class CommentController extends Controller
{
    protected $service;
    public function __construct(CommentService $service)
    {
        $this->service = $service;
        $this->middleware('auth:api')->except('index', 'show');
    }

    public function index()
    {
        return $this->service->index();
    }

    public function show(Comment $comment)
    {
        return $this->service->show($comment);
    }

    public function edit(Comment $comment)
    {
        return $this->service->edit($comment);
    }

    public function store(CommentRequest $request)
    {
        return $this->service->store($request->validated());
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        return $this->service->update($comment, $request->validated());
    }

    public function destroy(Comment $comment)
    {
        return $this->service->destroy($comment);
    }
}
