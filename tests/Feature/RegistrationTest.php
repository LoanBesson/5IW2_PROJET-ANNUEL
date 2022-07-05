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
    public function login_new_user()
    {
        $user = User::factory()->create();
        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertSuccessful();
    }



}
