<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
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
        View::composer([
            'layouts.partials.admin.sidebar',
        ], function ($view) {
            return $view->with(
                'setting',
                \App\Models\Setting::first()
            );
        });

        View::composer([
            'admin.promotion.include.action',
        ], function ($view) {
            return $view->with(
                'verificators',
                \App\Models\User::role('Verifikator')->get()
            );
        });
      
      	View::composer([
            'admin.promotion.include.action',
        ], function ($view) {
            return $view->with(
                'admins',
                \App\Models\User::role('Admin INKA')->get()
            );
        });
    }
}
