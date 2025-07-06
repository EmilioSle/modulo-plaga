<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PlagaController;
use App\Http\Controllers\LoteAfectadoController;
use App\Http\Controllers\MedidaSugeridaController;
use App\Http\Controllers\DeteccionController;
use App\Http\Controllers\ReporteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas API para la aplicación. Estas rutas son
| cargadas por el RouteServiceProvider dentro de un grupo que
| está asignado al middleware "api".
|
*/

// Ruta de prueba
Route::get('/ping', function () {
    return response()->json(['message' => 'API funcionando correctamente']);
});

// Rutas RESTful para cada entidad
Route::apiResource('plagas', PlagaController::class);
Route::apiResource('lote-afectados', LoteAfectadoController::class);
Route::apiResource('medidas-sugeridas', MedidaSugeridaController::class);
Route::apiResource('detecciones', DeteccionController::class);
Route::apiResource('reportes', ReporteController::class);

Route::post('/detecciones/ia', [DeteccionController::class, 'detectarConIA']);

