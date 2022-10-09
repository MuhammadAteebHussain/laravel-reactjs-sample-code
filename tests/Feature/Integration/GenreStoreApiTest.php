<?php

namespace Tests\Feature\Integration;

use App\Models\User;
use App\Services\General\UserService;
use Tests\TestCase;

class GenreStoreApiTest extends TestCase
{

    /**
     * setUp function
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->api = 'api/genre/store';
        $this->user = $this->app->make(UserService::class);
        $this->email = User::orderBy('created_at', 'desc')->first()->email;
        $this->password = 'Ateeb@12345';
        $this->valid_genre_id = 1;
        $this->invalid_genre_id = 99999;
        $this->valid_film_id = 1;
        $this->invalid_film_id = 100000;
    }


    public function test_store_genre_unauthenticated()
    {

        $response = $this->post(
            $this->api,
            [],
            ['HTTP_ACCEPT' => 'application/json']
        );
        $response->assertStatus(401);
        $response->assertSee("Unauthenticated");
    }


    public function test_store_genre_genre_id_required()
    {
        $validated_request = array(
            'email' => $this->email,
            'password' => $this->password,

        );
        $token = $this->user->login($validated_request);

        $body   = array(
            'film_id' => $this->valid_film_id,

        );

        $response = $this->post(
            $this->api,
            $body,
            [
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_AUTHORIZATION' => 'Bearer ' . $token['body']['token'],
            ]
        );
        $response->assertStatus(400);
        $response->assertSee(false);
    }


    public function test_store_genre_film_id_required()
    {
        $validated_request = array(
            'email' => $this->email,
            'password' => $this->password,

        );
        $token = $this->user->login($validated_request);

        $body   = array(
            'genre_id' => $this->valid_film_id,
        );

        $response = $this->post(
            $this->api,
            $body,
            [
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_AUTHORIZATION' => 'Bearer ' . $token['body']['token'],
            ]
        );
        $response->assertStatus(400);
        $response->assertSee(false);
    }


    public function test_store_genre_film_id_invalid()
    {
        $validated_request = array(
            'email' => $this->email,
            'password' => $this->password,

        );
        $token = $this->user->login($validated_request);

        $body   = array(
            'film_id' => $this->invalid_film_id,
            'genre_id' => $this->valid_genre_id,
        );

        $response = $this->post(
            $this->api,
            $body,
            [
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_AUTHORIZATION' => 'Bearer ' . $token['body']['token'],
            ]
        );
        $response->assertStatus(400);
        $response->assertSee(false);
    }



    public function test_store_genre_genre_id_invalid()
    {
        $validated_request = array(
            'email' => $this->email,
            'password' => $this->password,

        );
        $token = $this->user->login($validated_request);

        $body   = array(
            'film_id' => $this->valid_film_id,
            'genre_id' => $this->invalid_genre_id,
        );

        $response = $this->post(
            $this->api,
            $body,
            [
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_AUTHORIZATION' => 'Bearer ' . $token['body']['token'],
            ]
        );
        $response->assertStatus(400);
        $response->assertSee(false);
    }


    public function test_store_genre_successfully()
    {
        $validated_request = array(
            'email' => $this->email,
            'password' => $this->password,

        );
        $token = $this->user->login($validated_request);

        $body   = array(
            'film_id' => $this->valid_film_id,
            'genre_id' => $this->valid_genre_id,
        );

        $response = $this->post(
            $this->api,
            $body,
            [
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_AUTHORIZATION' => 'Bearer ' . $token['body']['token'],
            ]
        );
        $response->assertStatus(200);
        $response->assertSee(false);
    }
}
