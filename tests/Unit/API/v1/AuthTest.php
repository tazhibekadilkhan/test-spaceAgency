<?php

namespace Tests\Unit\API\v1;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function user_can_login_and_get_access_token()
    {
        // Создаем пользователя
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Отправляем запрос на вход с правильными учетными данными
        $data = [
            'grant_type' => 'password',
            'client_id' => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'username' => 'test@example.com',
            'password' => 'password',
            'scope' => '',
        ];

        // Отправляем запрос на получение токена доступа
        $response = $this->postJson('/oauth/token', $data);

        // Проверяем, что запрос был успешным
        $response->assertStatus(200);

        // Проверяем наличие данных о пользователе и токена доступа в ответе
        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in',
        ]);

        // Проверяем, что токен доступа был успешно создан для пользователя
        $this->assertDatabaseHas('oauth_access_tokens', [
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function user_cannot_login_with_invalid_credentials()
    {
        // Отправляем запрос на вход с неправильными учетными данными
        $response = $this->postJson('/api/v1/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        // Проверяем, что запрос был неуспешным
        $response->assertStatus(401);
    }

    /** @test */
    public function user_can_register()
    {
        // Подготовка данных для запроса
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        // Отправляем запрос на регистрацию
        $response = $this->postJson('/api/v1/register', $userData);

        // Проверяем, что запрос был успешным
        $response->assertStatus(201);
        unset($userData['password']);
        unset($userData['password_confirmation']);

        // Проверяем наличие сообщения о успешной регистрации и данных пользователя в ответе
        $response->assertJson([
            'message' => 'Пользователь успешно зарегистрирован.',
            'user' => $userData,
        ]);

        // Проверяем, что пользователь был создан в базе данных
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }

    /** @test */
    public function user_cannot_register_with_invalid_data()
    {
        // Подготовка данных для запроса (неполные данные)
        $userData = [
            'name' => 'John Doe',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        // Отправляем запрос на регистрацию с неполными данными
        $response = $this->postJson('/api/v1/register', $userData);

        // Проверяем, что запрос был неуспешным
        $response->assertStatus(422);

        // Проверяем, что в ответе есть сообщение об ошибке валидации
        $response->assertJsonValidationErrors(['email']);
    }
}
