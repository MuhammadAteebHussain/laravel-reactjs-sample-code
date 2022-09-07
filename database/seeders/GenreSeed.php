<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Genre::Create(['genre' => 'Action', 'status'=>1]);
        Genre::Create(['genre' => 'Romantic', 'status'=>1]);
        Genre::Create(['genre' => 'Motivation', 'status'=>1]);
        Genre::Create(['genre' => 'Arabic', 'status'=>1]);

    }
}
