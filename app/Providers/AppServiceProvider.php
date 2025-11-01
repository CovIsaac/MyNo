<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Priority;

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
        // Share the priorities list with the main layout so views that include
        // the layout have access to $priorities without each controller needing
        // to pass it explicitly.
        // Avoid running this while executing artisan console commands (migrations, etc.).
        if (! $this->app->runningInConsole()) {
            // Attach priorities to the component view (not the layout wrapper) to
            // avoid triggering the AppLayout component recursively.
            View::composer('components.app-layout', function ($view) {
                $view->with('priorities', Priority::orderBy('id')->get());
            });
        }
    }
}
