<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        if (!$roleUser = Role::where('alias', 'user')->first()) {
            $roleUser = Role::factory()->create([
                'name' => 'User',
                'alias' => 'user',
            ]);
        }

        if (!Role::where('alias', 'moderator')->first()) {
            $roleModerator = Role::factory()->create([
                'name' => 'Moderator',
                'alias' => 'moderator',
            ]);

            $moderator = User::factory()->create([
                'name' => 'Moderator User',
                'password' => bcrypt('password')
            ]);

            UserRole::factory()->create([
                'user_id' => $moderator->id,
                'role_id' => $roleModerator->id
            ]);
        }

        if (User::all()->count() < 3) {
            $users = User::factory()
                ->count(50)
                ->create();

            foreach ($users as $user) {
                UserRole::factory()->create([
                    'role_id' => $roleUser->id,
                    'user_id' => $user->id,
                ]);
            }

            Category::factory()
                ->count(10)
                ->hasPosts(15)
                ->create();
        }
    }
}
