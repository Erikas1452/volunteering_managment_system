<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VolunteerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_go_to_login_page()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_go_to_register_page()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_login_volunteer()
    {
        $response = $this->post('/volunteer/login', [
            'email' => "eee1452@gmail.com",
            'password' =>"cikas1452"
        ]);

        $response->assertRedirect('/volunteering');
    }

    public function test_register_existing_volunteer()
    {
        $response = $this->from('/register')->post('/volunteer/register', [
            'email' => "eee1452@gmail.com",
            'full_name' => "Erikas Tumanovas",
            'password' =>"cikas1452"
        ]);

        $response->assertRedirect('/register');
    }

    public function test_login_volunteer_and_go_to_activities()
    {
        $response = $this->post('/volunteer/login', [
            'email' => "eee1452@gmail.com",
            'password' =>"cikas1452"
        ]);

        $response = $this->get('/volunteer/my/volunteerings');
        $response->assertStatus(200);
    }

    public function test_logged_in_volunteer_and_go_to_my_activities()
    {
        $response = $this->post('/volunteer/login', [
            'email' => "eee1452@gmail.com",
            'password' =>"cikas1452"
        ]);

        $response = $this->get('/volunteer/my/volunteerings');
        $response->assertStatus(200);
    }

    public function test_logged_in_volunteer_and_go_to_profile()
    {
        $response = $this->post('/volunteer/login', [
            'email' => "eee1452@gmail.com",
            'password' =>"cikas1452"
        ]);

        $response = $this->get('/profile/1');
        $response->assertStatus(200);
    }

    // /volunteering/search

    public function test_logged_in_volunteer_search()
    {
        $response = $this->post('/volunteer/login', [
            'email' => "eee1452@gmail.com",
            'password' =>"cikas1452"
        ]);

        $response = $this->get('/volunteering/');

        $response = $this->post('/volunteering/search/', [
            'search_word' => "testSearch",
        ]);

        $response->assertStatus(200);
    }

    public function test_logged_in_volunteer_history()
    {
        $response = $this->post('/volunteer/login', [
            'email' => "eee1452@gmail.com",
            'password' =>"cikas1452"
        ]);

        $response = $this->get('/volunteering/history/');


        $response->assertStatus(200);
    }


    public function test_bad_password_on_login_volunteer()
    {
        $response = $this->from('login')->post('/volunteer/login', [
            'email' => "eee1452@gmail.com",
            'password' =>"cikas142"
        ]);

        $response->assertRedirect('login');
    }

    public function test_bad_email_on_login_volunteer()
    {
        $response = $this->from('login')->post('/volunteer/login', [
            'email' => "eee41452@gmail.com",
            'password' =>"cikas1452"
        ]);

        $response->assertRedirect('login');
    }
}
