<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdminComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            [
                'admin.index',
                'admin.articles.*',
                'admin.channels.*',
                'admin.classifies.*',
                'admin.orders.*',
                'admin.products.*',
                'admin.users.*',
            ],
            'App\Http\ViewComposer\Admin\NavigationComposer'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
