<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
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
        $response = $this->postJson('/api/registration', [
            'name' => 'Constantin Druc',
            'email' => 'druc@pinsmile.com',
            'password' => 'password'
        ]);

        $response->assertSuccessful();

        $user = User::where('email', 'druc@pinsmile.com')->first();
        Notification::assertSentTo($user, VerifyEmail::class);

        $this->assertNotEmpty($response->getContent());
        $this->assertDatabaseHas('users', ['email' => 'druc@pinsmile.com']);

    }
}
