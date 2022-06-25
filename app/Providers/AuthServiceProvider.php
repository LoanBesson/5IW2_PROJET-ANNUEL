<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Property;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Contact' => 'App\Policies\ContactPolicy',
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

        Gate::define('isAdmin', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('create-contact', function (User $user, $property_id) {
            $property = Property::find($property_id);
            if ($property) {
                return $user->id != $property->user_id;
            }
            return false;
        });
    }
}
