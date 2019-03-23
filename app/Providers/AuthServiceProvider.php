<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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
        //COPIED!!
        Gate::define('students.update', function ($user) {
            return ($user->role == 'admin');
        });

        Gate::define('lectures.update', function ($user) {
            return ($user->role == 'admin');
        });

        Gate::define('students.trash', function ($user) {
            return ($user->role == 'admin');
        });

        Gate::define('lectures.trash', function ($user) {
            return ($user->role == 'admin');
        });
        
        $this->registerPolicies();
    }
}
