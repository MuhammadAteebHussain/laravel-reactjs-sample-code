<?php

namespace Tests\Feature\Integration;

use App\Models\User;
use App\Services\General\UserService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentStoreApiTest extends TestCase
{

    use WithFaker;
    /**
     * setUp function
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->api = 'api/comment/store';
        $this->user = $this->app->make(UserService::class);
        $this->email = User::orderBy('created_at', 'desc')->first()->email;
        $this->user_id = User::orderBy('created_at', 'desc')->first()->id;
        $this->invalid_user_id = 999999;
        $this->password = 'Ateeb@12345';
        $this->valid_genre_id = 1;
        $this->invalid_genre_id = 99999;
        $this->valid_film_id = 1;
        $this->invalid_film_id = 100000;
        $this->comment = $this->faker->text(200);
    }


    public function test_store_comment_unauthenticated()
    {

        $response = $this->post(
            $this->api,
            [],
            ['HTTP_ACCEPT' => 'application/json']
        );
        $response->assertStatus(401);
        $response->assertSee("Unauthenticated");
    }


    public function test_store_comment_user_id_required()
    {
        $validated_request = array(
            'email' => $this->email,
            'password' => $this->password,
            'comment' => $this->comment

        );
        $token = $this->user->login($validated_request);

        $body   = array(
            'user_id' => '',
            'film_id' => $this->valid_film_id,
            'comment' => $this->comment,

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


    public function test_store_comment_film_id_required()
    {
        $validated_request = array(
            'email' => $this->email,
            'password' => $this->password,

        );
        $token = $this->user->login($validated_request);

        $body   = array(
            'user_id' => $this->user_id,
            'film_id' => '',
            'comment' => $this->comment,
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

    public function test_store_comment_commit_required()
    {
        $validated_request = array(
            'email' => $this->email,
            'password' => $this->password,

        );
        $token = $this->user->login($validated_request);

        $body   = array(
            'user_id' => $this->user_id,
            'film_id' => $this->valid_film_id,
            'comment' => '',
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

    public function test_store_comment_user_id_invalid()
    {
        $validated_request = array(
            'email' => $this->email,
            'password' => $this->password,

        );
        $token = $this->user->login($validated_request);

        $body   = array(
            'user_id' => $this->invalid_user_id,
            'film_id' => $this->valid_film_id,
            'comment' => $this->comment
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


    public function test_store_comment_film_id_invalid()
    {
        $validated_request = array(
            'email' => $this->email,
            'password' => $this->password,

        );
        $token = $this->user->login($validated_request);

        $body   = array(
            'user_id' => $this->user_id,
            'film_id' => $this->invalid_film_id,
            'comment' => $this->comment
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


    public function test_store_comment_successfully()
    {
        $validated_request = array(
            'email' => $this->email,
            'password' => $this->password,

        );
        $token = $this->user->login($validated_request);

        $body   = array(
            'user_id' => $this->user_id,
            'film_id' => $this->valid_film_id,
            'comment' => $this->comment
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
        $response->assertSee(true);
    }
}
