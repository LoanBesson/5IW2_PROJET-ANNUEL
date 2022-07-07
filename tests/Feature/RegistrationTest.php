<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function register_new_user()
    {
        Notification::fake();
        $response = $this->postJson('/api/auth/register', [
            'lastname' => 'Druc',
            'firstname' => 'Constantin',
            'email' => 'druc@pinsmile.com',
            'password' => 'password'
        ]);

        $response->assertSuccessful();


    }



    /** @test */

    //login_new_user
    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();
        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertSuccessful();
    }

    /** @test */
    //test_users_can_not_authenticate_with_invalid_password
    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();
        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'invalid'
        ]);

        $response->assertStatus(422);
    }




}
