<?php

namespace Database\Seeders;

use App\Models\FilmGenre;
use Illuminate\Database\Seeder;

class FilmGenreSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FilmGenre::factory()->times(10)->create();
    }
}
