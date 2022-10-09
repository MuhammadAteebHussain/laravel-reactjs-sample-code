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
    
        $this->call([
            FilmsTableSeeder::class,
            GenreSeed::class,
            UserSeeder::class,
            FilmGenreSeed::class,
            FilmUserRatingSeed::class,
            CommentsSeed::class,
            CountryTableSeed::class,
        ]);
        
    }
}
