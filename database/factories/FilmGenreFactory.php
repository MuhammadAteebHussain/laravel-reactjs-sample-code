<?php

namespace Database\Factories;

use App\Models\FilmGenre;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilmGenreFactory extends Factory
{

    protected $model=FilmGenre::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'genre_id' => rand(1,4),
            'film_id' => rand(1,3)
        ];
    }
}
