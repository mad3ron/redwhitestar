<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('manage-users', function ($user) {
        //     return $user->hasPermissionTo('manage-users');
        // });

        ResetPassword::createUrlUsing(function ($user, string $token) {
            return 'http://apptrans.test/reset-password/'.$token;
        });
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verify Email Address')
                ->line('Click the button below to verify your email address.')
                ->lineIf($notifiable->provider, 'Your username is: '.$notifiable->username)
                ->lineIf($notifiable->provider, 'Please change your password: '.$notifiable->password)
                ->action('Verify Email Address', $url);
        });
    }
}
