<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('admin', function (User $user) {
            return $user->role->nama == 'Admin';
        });

        Gate::define('masuk', function (User $user) {
            return $user->role->nama == 'Operator Masuk';
        });

        Gate::define('keluar', function (User $user) {
            return $user->role->nama == 'Operator Keluar';
        });
    }
}
