<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

use App\RedesSociales;
use App\DatoEmpresa;
use App\logo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Route::resourceVerbs([
            'create' => 'crear',
            'edit' => 'editar',
        ]);

        Schema::defaultStringLength(191);

        // favicon
        $favicon= Logo::find(3);
        view()->share('favicon', $favicon);

        // logo principal
        $logoPrincipal= Logo::find(1);
        view()->share('logoPrincipal', $logoPrincipal);

        // direcionEmpresa
        $direcionEmpresa = DatoEmpresa::find(1);
        view()->share('direcionEmpresa', $direcionEmpresa);

        // telefonoEmpresa
        $telefonoEmpresa = DatoEmpresa::find(2);
        view()->share('telefonoEmpresa', $telefonoEmpresa);

        // correoEmpresa
        $correoEmpresa = DatoEmpresa::find(3);
        view()->share('correoEmpresa', $correoEmpresa);

        // listdo de redes para menu principal
        $redesSuperior = RedesSociales::where('ubicacion', 'superior')->get();
        view()->share('redesSuperior', $redesSuperior);
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
