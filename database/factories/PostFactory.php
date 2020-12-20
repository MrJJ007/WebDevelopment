<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
            return [
                'user' =>  $this->faker->lastName(),
                'content' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
                'user_id'=>$this ->faker->NumberBetween(1,20),

            ];
    }
}
