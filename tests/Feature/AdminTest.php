<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_login_page()
    {
        $response = $this->get('/admin/login/');

        $response->assertStatus(200);
    }

    public function test_login_admin()
    {
        $response = $this->post('/admin/authenticate', [
            'email' => "admin@gmail.com",
            'password' =>"admin"
        ]);

        $response->assertRedirect('/admin/dashboard/');
    }

    public function test_admin_dashboard(){
        $response = $this->post('/admin/authenticate', [
            'email' => "admin@gmail.com",
            'password' =>"admin"
        ]);

        $response = $this->get('/admin/dashboard/');
        $response->assertStatus(200);
    }

    public function test_admin_dashboard_users(){
        $response = $this->post('/admin/authenticate', [
            'email' => "admin@gmail.com",
            'password' =>"admin"
        ]);

        $response = $this->get('/admin/dashboard/users');
        $response->assertStatus(200);
    }

    public function test_admin_dashboard_organizations(){
        $response = $this->post('/admin/authenticate', [
            'email' => "admin@gmail.com",
            'password' =>"admin"
        ]);

        $response = $this->get('/admin/dashboard/organizations');
        $response->assertStatus(200);
    }

    public function test_admin_dashboard_organizations_requests(){
        $response = $this->post('/admin/authenticate', [
            'email' => "admin@gmail.com",
            'password' =>"admin"
        ]);

        $response = $this->get('/admin/dashboard/organization/requests');
        $response->assertStatus(200);
    }

    public function test_admin_dashboard_registration_page(){
        $response = $this->post('/admin/authenticate', [
            'email' => "admin@gmail.com",
            'password' =>"admin"
        ]);

        $response = $this->get('/admin/dashboard/organizations/register');
        $response->assertStatus(200);
    }

    public function test_admin_dashboard_categories_page(){
        $response = $this->post('/admin/authenticate', [
            'email' => "admin@gmail.com",
            'password' =>"admin"
        ]);

        $response = $this->get('/admin/dashboard/categories/');
        $response->assertStatus(200);
    }

    public function test_admin_log_out(){
        $response = $this->post('/admin/authenticate', [
            'email' => "admin@gmail.com",
            'password' =>"admin"
        ]);

        $response = $this->get('/admin/logout');
        $response->assertStatus(302);
    }

}
