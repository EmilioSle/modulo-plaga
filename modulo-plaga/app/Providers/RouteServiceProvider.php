<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home';

    public function boot(): void
    {
        $this->routes(function () {
            // Rutas API con prefijo 'api' y middleware 'api'
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Rutas web con middleware 'web'
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
