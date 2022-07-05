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

    public function testLogin()
    {
        // Creating Users
        User::create([
            'name' => 'Test',
            'email'=> $email = time().'@example.com',
            'password' => $password = bcrypt('123456789')
        ]);

        // Simulated landing
        $response = $this->json('POST',route('login'),[
            'email' => $email,
            'password' => $password,
        ]);

        // Determine whether the login is successful and receive token
        $response->assertStatus(200);

        //$this->assertArrayHasKey('token',$response->json());

        // Delete users
        User::where('email','test@gmail.com')->delete();
    }
}
