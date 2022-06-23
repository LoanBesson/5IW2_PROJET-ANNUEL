<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            $spaUrl = "http://localhost:4200/verification-email//?url=$url";

            return (new MailMessage)
                ->subject('Mail de verification')
                ->line('Cliquer sur le lien pour activer votre compte.')
                ->action('Verify Email Address', $spaUrl);
        });

        Gate::define('isAdmin', function ($user) {
            return $user->isAdmin();
        });
    }
}
