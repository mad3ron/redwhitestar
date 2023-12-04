<?php

namespace App\Providers;

use App\Models\Cso\Booking;
use App\Observers\BookingObserver;
use Illuminate\Support\Facades\Blade;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('role', function ($role) {
            return "<?php if (auth()->check() && auth()->user()->hasRole({$role})): ?>";
        });

        Blade::directive('endrole', function () {
            return '<?php endif; ?>';
        });

        Debugbar::enable();

        // Registrasi Observer
        // Booking::observe(BookingObserver::class);
    }
}
