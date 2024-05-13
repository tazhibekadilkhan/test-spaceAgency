<?php

namespace Tests\Unit\API\v1;

use App\Models\Priority;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Database\Factories\TaskFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
//    public function task_index()
//    {
//        // Создаем
//        $status = Status::factory()->create();
//        $priority = Priority::factory()->create();
//
//        $user = User::factory()->create([
//            'email' => 'test@example.com',
//            'password' => bcrypt('password')
//        ]);
//
//        $tasks = Task::factory(20)->create([
//            'status_id' => $status->id,
//            'priority_id' => $priority->id,
//            'user_id' => $user->id
//        ]);
//
//        // Вызываем эндпоинт, который возвращает пагинированные данные
//        $response = $this->withHeaders([
//            'Authorization' => 'Bearer ' . $this->get_user_token()
//        ])->json('GET', '/api/v1/tasks');
//
//        // Проверяем структуру ответа и данные
//        $response->assertJsonStructure([
//            'message',
//            'data' => [
//                'items',
//                'hasNext',
//                'currentPage',
//                'lastPage',
//            ],
//        ])->assertJson([
//            'message' => 'Успешно.',
//            'data' => [
//                'items' => $tasks->toArray(),
//                'hasNext' => false,
//                'currentPage' => 1,
//                'lastPage' => 1,
//            ],
//        ]);
//
//    }


    /** @test */
    public function it_returns_paginated_task_data_with_authorization_token()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ]);

        // Создание статуса и приоритета
        $status = Status::factory()->create();
        $priority = Priority::factory()->create();


        $tasks = Task::factory(20)->create([
            'status_id' => $status->id,
            'priority_id' => $priority->id,
            'user_id' => $user->id
        ]);

        $response = $this->withToken($this->getAccessToken())->json('GET', '/api/v1/tasks');


        $response->assertOk()
            ->assertJsonStructure(['message', 'data' => ['items', 'hasNext', 'currentPage', 'lastPage']])
            ->assertJson([
                'message' => 'Успешно.',
                'data' => [
                    'items' => $tasks->toArray(),
                    'hasNext' => false,
                    'currentPage' => 1,
                    'lastPage' => 1,
                ]
            ]);
    }

    /** @test */
    public function user_can_create_task()
    {
        // Создание статуса и приоритета
        $status = Status::factory()->create();
        $priority = Priority::factory()->create();

        // Создание пользователя
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ]);

        // Подготовка данных для создания задачи
        $data = [
            'name' => 'task 1',
            'description' => 'description',
            'status_id' => $status->id,
            'priority_id' => $priority->id
        ];

        // Отправка запроса на создание задачи
        $response = $this->withToken($this->getAccessToken())->postJson('/api/v1/tasks', $data);

        // Удаление ненужных полей из данных
        unset($data['status_id']);
        unset($data['priority_id']);

        // Проверка успешности запроса и соответствия данных
        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Успешно.',
                'data' => $data,
            ]);
    }

    /** @test */
    public function user_cannot_create_task_with_invalid_data()
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ]);

        // Подготовка данных для запроса
        $data = [
            'name' => 'task 1',
            'description' => 'description',
        ];

        // Отправляем запрос на создание
        $response = $this->withToken($this->getAccessToken())->postJson('/api/v1/tasks', $data);

        // Проверяем, что запрос был неуспешным
        $response->assertStatus(422);

        // Проверяем, что в ответе есть сообщение об ошибке валидации
        $response->assertJsonValidationErrors(['status_id', 'priority_id']);
    }

    /** @test */
    public function user_can_update_task()
    {
        // Создание статуса и приоритета
        $status = Status::factory()->create();
        $priority = Priority::factory()->create();

        // Создание пользователя
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ]);

        // Подготовка данных для задачи
        $task = Task::factory()->create([
            'name' => 'task 1',
            'description' => 'description',
            'status_id' => $status->id,
            'priority_id' => $priority->id
        ]);

        // Подготовка данных для обновления задачи
        $data = [
            'name' => 'task 2',
            'description' => 'description 2',
            'status_id' => $status->id,
            'priority_id' => $priority->id,
            'deadline' => Carbon::parse($task->deadline)->format('d.m.Y')
        ];

        // Отправка запроса на обновление задачи
        $response = $this->withToken($this->getAccessToken($user))->putJson('/api/v1/tasks/'. $task->id, $data);

        // Удаление ненужных полей из данных
        unset($data['status_id']);
        unset($data['priority_id']);

        // Проверка успешности запроса и соответствия данных
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Успешно.',
                'data' => $data,
            ]);
    }

    /** @test */
    public function user_cannot_update_task_with_invalid_data()
    {
        // Создание статуса и приоритета
        $status = Status::factory()->create();
        $priority = Priority::factory()->create();

        // Создание пользователя
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ]);

        // Подготовка данных для запроса
        $task = Task::factory()->create([
            'name' => 'task 1',
            'description' => 'description',
            'status_id' => $status->id,
            'priority_id' => $priority->id
        ]);

        $data = [
            'name' => 'task 2',
            'description' => 'description 2',
            'status_id' => 999999,
            'priority_id' => 999999,
            'deadline' => Carbon::parse($task->deadline)->format('d.m.Y H:i')
        ];


        // Отправляем запрос на создание
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->getAccessToken()
        ])->putJson('/api/v1/tasks/'. $task->id, $data);


        // Проверяем, что запрос был неуспешным
        $response->assertStatus(422);

        // Проверяем, что в ответе есть сообщение об ошибке валидации
        $response->assertJsonValidationErrors(['deadline', 'priority_id', 'status_id']);
    }

    private function getAccessToken()
    {
        $data = [
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        // Отправляем запрос на получение токена доступа
        $response = $this->postJson('/api/v1/login', $data);

        // Извлечение токена доступа из ответа и возврат его
        return $response->json()['data']['authorization']['access_token'];
    }
}
