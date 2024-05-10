<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Requests\v1\Auth\LoginRequest;
use App\Http\Requests\v1\Auth\RegisterRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::guard('web')->attempt($credentials))
            return response()->json([
                'errors' => array(array('Введенные Вами данные неверены'))
            ], 401);

        $user = Auth::guard('web')->user();

        try {

            $client = DB::table('oauth_clients')
                ->where('password_client', true)
                ->first();

            $data = [
                'grant_type' => 'password',
                'client_id' => $client->id,
                'client_secret' => $client->secret,
                'username' => $credentials['email'],
                'password' => $credentials['password'],
                'scope' => '*'
            ];

            $response = Http::asForm()->post(env('APP_URL'). '/oauth/token', $data);
            $response = $response->json();

            if (!isset($response['access_token'])) {
                return response()->json(['error' => 'Ошибка при получении токена'], 500);
            }

            $response['user'] = $user;

            return response()->json([
                'data' => $response
            ]);

        } catch (\Exception $e) {
            Log::error('Произошла ошибка: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create(array_merge(
                $request->validated(),
                ['password' => bcrypt($request->password)]
            ));

            return response()->json([
                'message' => 'Пользователь успешно зарегистрирован.',
                'user' => $user
            ], 201);
        } catch (Exception $e) {
            // Обработка исключения
            Log::error('Произошла ошибка при регистрации: ' . $e->getMessage());
            return response()->json(['error' => 'Произошла ошибка при регистрации'], 500);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::user()->token()->revoke();
        return response()->json(['message' => 'Пользователь успешно вышел из системы.']);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json([
            'data' => auth()->user(),
        ]);
    }
}
