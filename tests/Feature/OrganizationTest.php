<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrganizationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_organization_go_to_home_page()
    {
        $response = $this->get('/organization/home');

        $response->assertStatus(200);
    }

    public function test_organization_login_page()
    {
        $response = $this->get('/organization/login/');

        $response->assertStatus(200);
    }

    public function test_login_organization()
    {
        $response = $this->post('/organization/login/authenticate', [
            'email' => "RaudonasisKryzius@gmail.com",
            'password' =>"K571WBeDpUQj"
        ]);

        $response->assertRedirect('/organization/dashboard/');
    }

    public function test_organization_dashboard(){
        $response = $this->post('/organization/login/authenticate', [
            'email' => "RaudonasisKryzius@gmail.com",
            'password' =>"K571WBeDpUQj"
        ]);

        $response = $this->get('/organization/dashboard/');
        $response->assertStatus(200);
    }

    public function test_organization_dashboard_activities(){
        $response = $this->post('/organization/login/authenticate', [
            'email' => "RaudonasisKryzius@gmail.com",
            'password' =>"K571WBeDpUQj"
        ]);

        $response = $this->get('/organization/dashboard/activities');
        $response->assertStatus(200);
    }

    public function test_organization_dashboard_activities_handle(){
        $response = $this->post('/organization/login/authenticate', [
            'email' => "RaudonasisKryzius@gmail.com",
            'password' =>"K571WBeDpUQj"
        ]);

        $response = $this->get('/organization/dashboard/activities/handle');
        $response->assertStatus(200);
    }

    public function test_organization_dashboard_activities_create(){
        $response = $this->post('/organization/login/authenticate', [
            'email' => "RaudonasisKryzius@gmail.com",
            'password' =>"K571WBeDpUQj"
        ]);

        $response = $this->get('/organization/dashboard/activities/create');
        $response->assertStatus(200);
    }

    public function test_organization_dashboard_history(){
        $response = $this->post('/organization/login/authenticate', [
            'email' => "RaudonasisKryzius@gmail.com",
            'password' =>"K571WBeDpUQj"
        ]);

        $response = $this->get('/organization/dashboard/activities/history');
        $response->assertStatus(200);
    }

    public function test_organization_logout(){
        $response = $this->post('/organization/login/authenticate', [
            'email' => "RaudonasisKryzius@gmail.com",
            'password' =>"K571WBeDpUQj"
        ]);

        $response = $this->get('/organization/logout');
        $response->assertStatus(302);
    }

    

}
