<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::factory(20)->create();
        $posts = \App\Models\Post::factory(3)->has(\App\Models\Comment::factory()->count(3))->create();
    }
}
