<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model=Comment::class;

    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'film_id' => rand(1,3) ,
            'user_id' => rand(1,100),
            'comment' => $this->faker->text(200),         
        ];
    }
}
