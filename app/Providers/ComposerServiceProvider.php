<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer(['page.common.search', 'page.common.sidebar'] , 'App\Http\ViewComposer\LocationComposer');
        View::composer(['page.common.navbar', 'page.common.footer'] , 'App\Http\ViewComposer\CategoryComposer');
        View::composer(['page.common.sidebar_new'] , 'App\Http\ViewComposer\SidebarNewComposer');
    }
}
