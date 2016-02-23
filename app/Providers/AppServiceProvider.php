<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\Venue;
use App\Models\User;
use App\Models\Shift;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Role::deleting(function ($role) {
        //     if ( Shift::where('role_id', $role->id) ) {
        //         return false;
        //     }
        // });

        // Venue::deleting(function ($venue) {
        //     if ( Shift::where('venue_id', $venue->id) ) {
        //         return false;
        //     }
        // });

        // User::deleting(function ($user) {
        //     if ( Shift::where('user_id', $user->id) ) {
        //         return false;
        //     }
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }
    }
}
