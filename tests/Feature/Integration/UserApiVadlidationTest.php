<?php

namespace Tests\Feature\Integration;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class UserApiVadlidationTest extends TestCase
{

    
    public function test_register_user_api_validation_name_required()
    {
        $data = array(
            'name' => '',
            'email' => rand() . 'film@test.com',
            'password' => 'Password',
            'confirm_password' => 'Ateeb@123456',
        );
        $response = $this->post('api/user/register', $data);

        $response->assertStatus(400);
    }



    public function test_register_user_api_validation_name_wrong_format()
    {
        $data = array(
            'name' => 'ateeb123',
            'email' => rand() . 'film@test.com',
            'password' => 'Ateeb@123456',
            'confirm_password' => 'Ateeb@123456',
        );
        $response = $this->post('api/user/register', $data);

        $response->assertStatus(400);
    }


    public function test_register_user_api_validation_email_required()
    {
        $data = array(
            'name' => 'ateeb',
            'email' => '',
            'password' => 'Ateeb@123456',
            'confirm_password' => 'Ateeb@123456',
        );
        $response = $this->post('api/user/register', $data);

        $response->assertStatus(400);
    }


    /**
     * TODO.
     *
     * @return void
     */
    public function test_register_user_api_validation_email_already_exists()
    {
        $data = array(
            'name' => 'ateeb',
            'email' => User::first()->email,
            'password' => 'Ateeb@123456',
            'confirm_password' => 'Ateeb@123456',
        );
        $response = $this->post('api/user/register', $data);

        $response->assertStatus(400);
    }



    public function test_register_user_api_validation_password_required()
    {
        $data = array(
            'name' => 'ateeb',
            'email' => rand() . 'film@test.com',
            'password' => '',
            'confirm_password' => '',
        );
        $response = $this->post('api/user/register', $data);

        $response->assertStatus(400);
    }


    public function test_register_user_api_validation_confirm_password_not_match()
    {
        $data = array(
            'name' => 'ateeb',
            'email' => rand() . 'film@test.com',
            'password' => 'Ateeb@123456',
            'confirm_password' => 'Password',
        );
        $response = $this->post('api/user/register', $data);

        $response->assertStatus(400);
    }



    public function test_register_user_api_validation_wrong_password_format()
    {
        $data = array(
            'name' => 'ateeb',
            'email' => rand() . 'film@test.com',
            'password' => 'Password',
            'confirm_password' => 'Password',
        );
        $response = $this->post('api/user/register', $data);

        $response->assertStatus(400);
    }



    public function test_register_user_register_successfully()
    {
        $data = array(
            'name' => 'ateeb',
            'email' => rand() . 'film@test.com',
            'password' => 'Ateeb@12345',
            'confirm_password' => 'Ateeb@12345',
        );
        $response = $this->post('api/user/register', $data);
        // dd($response->getJson());
        // $this->assertEquals($response->getjson();)

        $response->assertSee([
            'success' => 'true',
        ]);
        $response->assertStatus(201);
    }


   
    
}
