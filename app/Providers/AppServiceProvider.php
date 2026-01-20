<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        Blade::directive('master', function ($expression) {
            return "<?php echo (\Illuminate\Support\Facades\Auth::check() && {$expression} instanceof \App\Models\Thing && {$expression}->master_id === \Illuminate\Support\Facades\Auth::id()) ? 'lalalala' : ''; ?>";
        });

        Blade::directive('inwork', function ($expression) {
            return "<?php echo ({$expression} instanceof \App\Models\Thing && {$expression}->usage->place->work) ? 'work' : '' ?>";
        });

        Blade::directive('inrepair', function ($expression) {
            return "<?php echo ({$expression} instanceof \App\Models\Thing && {$expression}->usage->place->repair) ? 'repair' : '' ?>";
        });
    }
}
