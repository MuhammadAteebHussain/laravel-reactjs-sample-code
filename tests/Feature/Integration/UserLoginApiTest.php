<?php

namespace Tests\Feature\Integration;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginApiTest extends TestCase
{
    

    public function test_get_token()
    {
        $data = array(
            'email' => User::orderBy('created_at', 'desc')->first()->email,
            'password' => 'Ateeb@12345',
        );
        $response = $this->post('api/user/login', $data);
    }

    public function test_login_email_required()
    {
        $data = array(
            'email' => '',
            'password' => 'Ateeb@123456'
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
            'email' =>  User::orderBy('created_at', 'desc')->first()->email,
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
            'email' =>  'test',
            'password' => 'Ateeb@123456',
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
            'password' => 'ateeb',
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
            'password' => 'Ateeb@12345',
        );
        $response = $this->post('api/user/login', $data);


        $response->assertSee([
            'code' => 'fm9001',
            'success' => 'true',
        ]);
        $response->assertStatus(200);
    }
}
