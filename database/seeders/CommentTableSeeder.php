<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //default info
        $a = new Comment;
        $a->user = "John";
        $a->user_id=1;
		$a->content = "This is such a terrible idea, stop using this platform (example of typical online comment)";
        $a->save();

        $a->user()->attach(1);//default position

        $commments = Comment::factory()->count(10)->create();
    }
}
