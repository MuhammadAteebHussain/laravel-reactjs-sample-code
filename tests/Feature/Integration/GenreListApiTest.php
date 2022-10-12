<?php

namespace Tests\Feature\Integration;

use Tests\TestCase;

class GenreListApiTest extends TestCase
{

    /**
     * setUp function
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->api = 'api/genre/list';
    }

    /**
     * test_fetch_film_by_slug_successfully function
     *
     * @return void
     */
    public function test_fetch_genre_by_slug_successfully()
    {
        $response = $this->get($this->api);
        $response->assertStatus(200);
        $response->assertSee("genre fetched");
        $response->assertSee(true);
    }


}
