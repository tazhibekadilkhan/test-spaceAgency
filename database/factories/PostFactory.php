<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $user_id;
    protected static ?string $category_id;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::inRandomOrder()->first()->id;

        return [
            'name' => fake()->sentence,
            'description' => fake()->text(500),
            'user_id' => $userId ?? null,
            'category_id' => static::$category_id ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            Comment::factory()->count(5)->create(['post_id' => $post->id]);
        });
    }
}
