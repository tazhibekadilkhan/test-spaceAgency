<?php

namespace App\Services;

use App\Repositories\CommentRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

final class CommentService extends CrudService
{
    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(array $data): JsonResponse
    {
        try {
            $data['user_id'] = Auth::id();
            return response()->json(['message' => 'Успешно.', 'data' => $this->repository->create($data)], 201);
        } catch (Exception $e) {
            // Обработка исключения
            Log::error('Произошла ошибка ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
