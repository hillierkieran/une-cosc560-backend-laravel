<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 1 admin user
        User::factory()->create([
            'role' => 'admin',
            'name' => 'Administrator',
            'email' => 'admin@example.com'
        ]);

        // Create 5 users, each with 10 posts
        User::factory(5)
        ->has(Post::factory(10))
        ->create();


        // $this->call(PostSeeder::class);
    }
}
