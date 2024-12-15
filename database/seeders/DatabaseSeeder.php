<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\PostUserLike;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'user',
            'phone' => 79999999999,
        ]);
        User::factory(5)->create();

        Post::factory(100)->create();

        Comment::factory(200)->create();

        PostUserLike::factory(300)->create();
    }
}
