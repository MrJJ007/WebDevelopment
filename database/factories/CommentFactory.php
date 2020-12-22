<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
            return [
                'user' => $this->faker->lastName(),
                'content' => $this->faker->realText($maxNbChars = 50, $indexSize = 2),
                'user_id'=>$this ->faker->NumberBetween(1,20),
                'post_id' => $this ->faker->NumberBetween(1,20),
                'multi_post_id' => $this ->faker->NumberBetween(1,20)
            ];
    }
}
