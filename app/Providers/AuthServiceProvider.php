<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Contact;
use App\Models\Favorite;
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
        // 'App\Model' => 'App\Policies\ModelPolicy',
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
                return $user->id !== $property->user_id;
            }
            return false;
        });

        Gate::define('access-contact', function (User $user, Contact $contact) {
            return $user->isAdmin() || $user->id === $contact->prospect_id;
        });

        Gate::define('access-favorite', function (User $user, Favorite $favorite) {
            return $user->isAdmin() || $user->id === $favorite->user_id;
        });
    }
}
