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
        // \App\Models\Film::factory(10)->create();
        // \App\Models\Film::factory(10)->create();
        $this->call([
            FilmsTableSeeder::class,
            GenreSeed::class,
            UserSeeder::class,
            FilmGenreSeed::class,
            FilmUserRatingSeed::class,
            CommentsSeed::class,
        ]);
        
    }
}
