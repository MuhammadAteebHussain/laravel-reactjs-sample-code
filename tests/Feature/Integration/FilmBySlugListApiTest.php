<?php

namespace Tests\Feature\Integration;

use Tests\TestCase;

class FilmBySlugListApiTest extends TestCase
{

    /**
     * setUp function
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->valid_slug = 'pirates-of-silicon-valley';
        $this->invalid_slug = 'pirates';
    }

    /**
     * test_fetch_film_by_slug_successfully function
     *
     * @return void
     */
    public function test_fetch_film_by_slug_successfully()
    {
        $api = 'api/film/' . $this->valid_slug;
        $response = $this->get($api);
        $response->assertStatus(200);
        $response->assertSee("Fetch Successfully");
        $response->assertSee(true);
    }

    /**
     * test_fetch_film_invalid_slug function
     *
     * @return void
     */
    public function test_fetch_film_invalid_slug()
    {
        $api = 'api/film/' . $this->invalid_slug;
        $response = $this->get($api);
        $response->assertStatus(400);
        $response->assertSee("The selected film slug is invalid");
    }
}
