<?php

namespace Tests\Feature\Integration;

use App\Models\Film;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class StoreFilmApiRequestValidationTest extends TestCase
{

    use WithFaker;
    /**
     * A basic Film Api Validation Request.
     *
     * @return void
     */


    public function film_can_store_successfully()
    {
        $response = $this->post('api/film/store');

        $response->assertStatus(200);
    }
    public function test_store_film_get_validation_message_name_feild_required()
    {
        $data = array(
            'name' => '',
            'film_slug' => 'cures-of-chucket',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry"s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged',
            'release_date' => '2019-01-01',
            'ticket_price' => '24.10',
            'country_id' => 1,
            'photo' =>  UploadedFile::fake()->create('invoice.png', 1024),
            'genre_ids' => 1,
        );
        $response = $this->post('api/film/store', $data);
        $response->assertStatus(400);
    }

    public function test_store_film_get_validation_message_film_slug_feild_required()
    {
        $data = array(
            'name' => 'Cures Of Chukey',
            'film_slug' => '',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry"s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged',
            'release_date' => '2019-01-01',
            'ticket_price' => '24.10',
            'country_id_id' => 1,
            'photo' =>  UploadedFile::fake()->create('invoice.png', 1024),
            'genre_ids' => 1,
        );
        $response = $this->post('api/film/store', $data);
        $response->assertStatus(400);
    }

    public function test_store_film_get_validation_message_description_feild_required()
    {
        $data = array(
            'name' => 'Cures Of Chukey',
            'film_slug' => 'cures-of-chucket',
            'description' => '',
            'release_date' => '2019-01-01',
            'ticket_price' => '24.10',
            'country_id' => 1,
            'photo' =>  UploadedFile::fake()->create('invoice.png', 1024),
            'genre_ids' => 1,
        );
        $response = $this->post('api/film/store', $data);
        $response->assertStatus(400);
    }

    public function test_store_film_get_validation_message_release_date_feild_required()
    {
        $data = array(
            'name' => 'Cures Of Chukey',
            'film_slug' => 'cures-of-chucket',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry"s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged',
            'release_date' => '',
            'ticket_price' => '24.10',
            'country_id' => 1,
            'photo' =>  UploadedFile::fake()->create('invoice.png', 1024),
            'genre_ids' => 1,
        );
        $response = $this->post('api/film/store', $data);
        $response->assertStatus(400);
    }
   

    public function test_store_film_get_validation_message_ticket_price_feild_required()
    {
        $data = array(
            'name' => 'Cures Of Chukey',
            'film_slug' => 'cures-of-chucket',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry"s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged',
            'release_date' => '2019-01-01',
            'ticket_price' => '',
            'country_id' => 1,
            'photo' =>  UploadedFile::fake()->create('invoice.png', 1024),
            'genre_ids' => 1,
        );
        $response = $this->post('api/film/store', $data);
        $response->assertStatus(400);
    }

    public function test_store_film_get_validation_message_country_id_feild_required()
    {
        $data = array(
            'name' => 'Cures Of Chukey',
            'film_slug' => 'cures-of-chucket',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry"s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged',
            'release_date' => '2019-01-01',
            'ticket_price' => '24.10',
            'country_id' => '',
            'photo' =>  UploadedFile::fake()->create('invoice.png', 1024),
            'genre_ids' => 1,
        );
        $response = $this->post('api/film/store', $data);
        $response->assertStatus(400);
    }

    public function test_store_film_get_validation_message_photo_feild_required()
    {
        $data = array(
            'name' => 'Cures Of Chukey',
            'film_slug' => 'cures-of-chucket',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry"s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged',
            'release_date' => '2019-01-01',
            'ticket_price' => '24.10',
            'country_id' => 1,
            'photo' =>  '',
            'genre_ids' => 1,
        );
        $response = $this->post('api/film/store', $data);
        $response->assertStatus(400);
    }
    
    public function test_store_film_get_validation_message_photo_feild_must_be_file()
    {
        $data = array(
            'name' => 'Cures Of Chukey',
            'film_slug' => 'cures-of-chucket',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry"s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged',
            'release_date' => '2019-01-01',
            'ticket_price' => '24.10',
            'country_id' => 1,
            'photo' =>  'no file',
            'genre_ids' => 1,
        );
        $response = $this->post('api/film/store', $data);
        $response->assertStatus(400);
    }
    

    public function test_store_film_get_validation_message_genre_id_feild_required()
    {
        $data = array(
            'name' => 'Cures Of Chukey',
            'film_slug' => 'cures-of-chucket',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry"s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged',
            'release_date' => '2019-01-01',
            'ticket_price' => '24.10',
            'country_id' => 1,
            'photo' =>  UploadedFile::fake()->create('invoice.png', 1024),
            'genre_ids' => '',
        );
        $response = $this->post('api/film/store', $data);
        $response->assertStatus(400);
    }


    public function test_store_film_successfully()
    {
        $faker = $this->faker->text(200);
        Film::factory();
        $data = array(
            'name' =>  $this->faker->title(),
            'film_slug' =>  $this->faker->slug(),
            'description' =>  $this->faker->text(),
            'release_date' => $this->faker->date(),
            'ticket_price' => 20.24,
            'country_id' => 1,
            'photo' =>  UploadedFile::fake()->create('invoice.png', 1024),
            'genre_ids' => rand(1,4),
        );        
        $response = $this->post('api/film/store', $data);
        $response->assertStatus(200);
    }
    
}
