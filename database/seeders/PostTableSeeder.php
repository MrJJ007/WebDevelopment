<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //default info
        $e = new Post;
        $e->user ="Bob";
        $e->user_id=1;
		$e->content = "slip sloop on the floor its time to do the shooty wooty";
        $e->save();

        $e->user()->attach(1);

        $posts = Post::factory()->count(10)->create();
    }
}
