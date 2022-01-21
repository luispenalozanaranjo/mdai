<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Proyecto;
use App\Policies\ProyectoPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Proyecto::class => ProyectoPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('noMostrar', function ($usuario, $proyecto) {
            
            $permisoObtenido = auth()->user()->proyecto->where('id', 1)->first();
            if(empty($permisoObtenido)){
                return true;
            }else {
                return false;
            }
    




        });
    }
}
