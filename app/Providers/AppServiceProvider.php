<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Prepares a polymorphic relation with the keywords to decouple
        // the application from database.
        Relation::morphMap([
            'bid'             => \App\Bid::class,
            'business'        => \App\Business::class,
            'service'         => \App\Service::class,
            'service_request' => \App\ServiceRequest::class,
            'user'            => \App\User::class,
        ]);

        // Fixes "Specified key was too long" error while migrating the
        // database.
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
