<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Film;
use App\Models\FilmGenre;
use App\Models\Genre;
use Facade\Ignition\Support\FakeComposer;
use Faker\Factory as Faker;

class FilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
        $data = array(
                    array(
                        'name'=>'Pirates Of Silicon Valley', 
                        'film_slug'=>'pirates-of-silicon-valley',
                        'description'=>'random description of table',
                        'release_date'=>'2022-01-01',
                        'ticket_price'=>'30',
                        'country'=>'UK',
                        'photo'=>'https://livijumpa2.files.wordpress.com/2013/12/impossible.jpg',
                        'status'=>'1'
                    
                    ),
                    array(
                        'name'=>'The Kinngdom', 
                        'film_slug'=>'the-kingdom',
                        'description'=>'random description of table',
                        'release_date'=>'2022-01-01',
                        'ticket_price'=>'40',
                        'country'=>'US',
                        'photo'=>'https://dcassetcdn.com/design_img/16298/35582/35582_406182_16298_image.jpg',
                        'status'=>'1'
                
                    ),
                array(
                    'name'=>'The Pirsuit of Happiness', 
                    'film_slug'=>'the-pirsuit-of-happiness',
                    'description'=>'random description of table',
                    'release_date'=>'2022-01-01',
                    'ticket_price'=>'50',
                    'country'=>'Germany',
                    'photo'=>'https://webneel.com/sites/default/files/imagecache/660Thumbnail/images/blog/movie-poster-design.jpg',
                    'status'=>'1'
            
                ),
            );
        $data=Film::insert($data);

    }
}
