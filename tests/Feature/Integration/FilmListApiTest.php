<?php

namespace Tests\Feature\Integration;

use App\Models\Film;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FilmListApiTest extends TestCase
{

    use WithFaker;


       /**
     * Set up the test
     */

    public function setUp(): void
    {
        parent::setUp();

    }

    public function test_fetch_film_successfully()
    {
        $response = $this->get('api/film/list');
        $response->assertStatus(200);
    }
    
}
