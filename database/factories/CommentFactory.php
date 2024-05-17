<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $user_id;
    protected static ?string $post_id;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::inRandomOrder()->first()->id;

        return [
            'content' => fake()->text(250),
            'user_id' => $userId,
            'post_id' => Post::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
