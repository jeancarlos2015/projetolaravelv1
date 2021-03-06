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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function ($user){
            return $user->email==='jeancarlospenas25@gmail.com' || $user->tipo==='Administrador';
        });

        Gate::define('acesso', function ($user){
            return isset($user->repositorio->nome) || $user->email==='jeancarlospenas25@gmail.com' || $user->tipo==='Administrador';
        });

        Gate::define('edit-user', function($userAuthenticated,$targetUser){
            return $userAuthenticated->id == $targetUser->id;
        });
    }
}
