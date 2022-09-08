<?php

namespace Database\Factories;

use App\Models\FilmUserRating;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilmUserRatingFactory extends Factory
{
    protected $model=FilmUserRating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'film_id' => rand(1,3),
            'user_id' => rand(1,100),
            'rating' => rand(1,5)
        ];
    }
}
