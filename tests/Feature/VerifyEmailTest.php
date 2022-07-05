<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class VerifyEmailTest extends TestCase
{
     use RefreshDatabase;

     /** @test */
     public function verify_email_address()
     {
        // VerifyEmail extends Illuminate\Auth\Notifications\VerifyEmail in this example
    $notification = new VerifyEmail();
    $user = User::factory()->create();

    // New user should not has verified their email yet
    $this->assertFalse($user->hasVerifiedEmail());

    $mail = $notification->toMail($user);
    $uri = $mail->actionUrl;

    // Simulate clicking on the validation link
    $this->get($uri)->assertRedirect(route('verification.verify', ['id' => $user->id, 'hash' => $mail->verificationHash]));



    // User should have verified their email
    $this->assertTrue(User::find($user->id)->hasVerifiedEmail());
     }

     /** @test */
     public function resend_verification_email()
     {
         Notification::fake();
         $user = User::create([
             'name' => 'Constantin Druc',
             'email' => 'druc@pinsmile.com',
             'password' => bcrypt('secret')
         ]);

         Sanctum::actingAs($user);

         $response = $this->postJson(route('api/auth/email/verification-notification'));
         $response->assertSuccessful();

         Notification::assertSentTo($user, VerifyEmail::class);
     }
}
