<?php

namespace Database\Seeders;

use App\Models\FilmUserRating;
use Illuminate\Database\Seeder;

class FilmUserRatingSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FilmUserRating::factory()->times(100)->create();
    }
}
