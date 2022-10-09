<?php

namespace Tests\Feature\Integration;

use App\Models\User;
use App\Services\General\UserService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserStoreApiTest extends TestCase
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
        $this->api = 'api/user/register';
        $this->valid_name = 'Ateeb';
        $this->user = $this->app->make(UserService::class);
        $this->email = User::orderBy('created_at', 'desc')->first()->email;
        $this->new_email = 'm.ateeb2@purevpn.com';
        $this->invalid_user_id = 999999;
        $this->password = 'Ateeb@12345';
        $this->confirm_password = 'Ateeb@12345';
        $this->valid_genre_id = 1;
        $this->invalid_genre_id = 99999;
        $this->valid_film_id = 1;
        $this->invalid_film_id = 100000;
    }


    public function test_store_user_name_required()
    {

        $body   = array(
            'email' => $this->new_email,
            'password' => $this->password,
            'confirm_password' => $this->confirm_password,
        );

        $response = $this->post(
            $this->api,
            $body,
            []
        );
        $response->assertStatus(400);
        $response->assertSee(false);
        $response->assertSee("The name field is required");
    }


    public function test_store_user_email_required()
    {

        $body   = array(
            'name' => $this->valid_name,
            'password' => $this->password,
            'confirm_password' => $this->confirm_password,
        );

        $response = $this->post(
            $this->api,
            $body,
            []
        );
        $response->assertStatus(400);
        $response->assertSee(false);
        $response->assertSee("The email field is required");
    }


    public function test_store_user_password_required()
    {
        $body   = array(
            'name' => $this->valid_name,
            'email' => $this->faker->email(),
            'confirm_password' => $this->confirm_password,
        );

        $response = $this->post(
            $this->api,
            $body,
            []
        );
        $response->assertStatus(400);
        $response->assertSee(false);
        $response->assertSee("The password field is required");
    }

    public function test_store_user_password_invalid_format()
    {

        $body   = array(
            'name' => $this->valid_name,
            'email' => $this->faker->email(),
            'password' => $this->valid_name,
            'confirm_password' => $this->confirm_password,
        );

        $response = $this->post(
            $this->api,
            $body,
            []
        );
        $response->assertStatus(400);
        $response->assertSee(false);
        $response->assertSee("The password format is invalid");
    }


    public function test_store_user_password_confirm_password_not_match()
    {
        $body   = array(
            'name' => $this->valid_name,
            'email' => $this->faker->email(),
            'password' => $this->password,
            'confirm_password' => $this->valid_name,
        );
        $response = $this->post(
            $this->api,
            $body,
            []
        );
        $response->assertStatus(400);
        $response->assertSee(false);
    }


    public function test_store_user_successfully()
    {
        $body   = array(
            'name' => $this->valid_name,
            'email' => $this->faker->email(),
            'password' => $this->password,
            'confirm_password' => $this->confirm_password,
        );

        $response = $this->post(
            $this->api,
            $body,
            []
        );
        $response->assertStatus(201);
        $response->assertSee(true);
        $response->assertSee("Register Successfully");
    }
}
