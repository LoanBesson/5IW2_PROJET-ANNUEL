<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;


use Tests\TestCase;


class ServicesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    // check_route_login_is_working
    public function check_route_login_is_working()
    {
        $response = $this->get('/api/auth/login');

        $response->assertSuccessful();
    }

    /** @test */
    // check_route_register_is_working
    public function check_route_register_is_working()
    {
        $response = $this->get('/api/auth/register');

        $response->assertSuccessful();
    }

    /** @test */
    // check_route_logout_is_working
    public function check_route_logout_is_working()
    {
        $response = $this->get('/api/auth/logout');

        $response->assertSuccessful();
    }

    /** @test */
    // check_route_user-profile_is_working
    public function check_route_user_profile_is_working()
    {
        $response = $this->get('/api/auth/user-profile');

        $response->assertSuccessful();
    }

    /** @test */
    // check_route_forgot_password_is_working
    public function check_route_forgot_password_is_working()
    {
        $response = $this->get('/api/auth/forgot-password');

        $response->assertSuccessful();
    }

    /** @test */
    // check_route_reset_password_is_working
    public function check_route_reset_password_is_working()
    {
        $response = $this->get('/api/auth/reset-password');

        $response->assertSuccessful();
    }

    /** @test */
    // check_route_contacts_is_working
    public function check_route_contact_is_working()
    {
        $response = $this->get('/api/contacts');

        $response->assertSuccessful();
    }

    /** @test */
    // check_route_favorites_is_working
    public function check_route_favorites_is_working()
    {
        $response = $this->get('/api/favorites');

        $response->assertSuccessful();
    }

    /** @test */
    // check_route_properties_is_working
    public function check_route_properties_is_working()
    {
        $response = $this->get('/api/properties');

        $response->assertSuccessful();
    }

    /** @test */
    // check_route_users_is_working
    public function check_route_users_is_working()
    {
        $response = $this->get('/api/users');

        $response->assertSuccessful();
    }

    /** @test */
    // check_route_search_is_working
    public function check_route_search_is_working()
    {
        $response = $this->get('/api/search');

        $response->assertSuccessful();
    }
























}
