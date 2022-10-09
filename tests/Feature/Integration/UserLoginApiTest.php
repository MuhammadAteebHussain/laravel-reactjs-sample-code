<?php

namespace Tests\Feature\Integration;

use App\Models\User;
use App\Services\General\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginApiTest extends TestCase
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
        $this->invalid_email = 'wrong email';
        $this->invalid_user_id = 999999;
        $this->password = 'Ateeb@12345';
        $this->confirm_password = 'Ateeb@12345';
        $this->invalid_password = 'ateeb';
        $this->valid_genre_id = 1;
        $this->invalid_genre_id = 99999;
        $this->valid_film_id = 1;
        $this->invalid_film_id = 100000;
    }



    public function test_login_email_required()
    {
        $data = array(
            'email' => '',
            'password' => $this->password
        );
        $response = $this->post('api/user/login', $data);
        $response->assertSee([
            'code' => 'fm1100',
            'success' => false,
        ]);
        $response->assertStatus(400);
    }

    public function test_login_password_required()
    {
        $data = array(
            'email' =>  $this->email,
            'password' => '',

        );
        $response = $this->post('api/user/login', $data);
        $response->assertSee([
            'code' => 'fm1100',
            'success' => false,
        ]);
        $response->assertStatus(400);
    }


    public function test_login_invalid_email()
    {
        $data = array(
            'email' =>  $this->invalid_email,
            'password' => $this->password,
        );
        $response = $this->post('api/user/login', $data);
        $response->assertSee([
            'code' => 'fm1100',
            'success' => false,
        ]);
        $response->assertStatus(400);
    }


    public function test_login_invalid_password()
    {
        $data = array(
            'email' => User::orderBy('created_at', 'desc')->first()->email,
            'password' =>  $this->invalid_password
        );
        $response = $this->post('api/user/login', $data);


        $response->assertSee([
            'code' => 'fm1100',
            'success' => false,
        ]);
        $response->assertStatus(400);
    }


    public function test_login_successfully()
    {
        $data = array(
            'email' => User::orderBy('created_at', 'desc')->first()->email,
            'password' => $this->password
        );
        $response = $this->post('api/user/login', $data);


        $response->assertSee([
            'code' => 'fm9001',
            'success' => 'true',
        ]);
        $response->assertStatus(200);
    }
}
