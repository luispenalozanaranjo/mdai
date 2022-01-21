<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(){
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){
        // Definimos la zona horaria global
        date_default_timezone_set('America/Santiago');
        Carbon::now()->settings(['timezone' => 'America/Santiago']);

        // DB::listen(function($query){
        //      var_dump([
        //         $query->sql,
        //         $query->bindings,
        //         //$query->time
        //     ]);
        // });
    }
}
