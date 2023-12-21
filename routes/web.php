<?php

use App\Http\Controllers\ConductorController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecorridoViajeController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\SolicitudCombustibleController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\UnidadSolicitanteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Route;


// VACIAR CACHE
Route::get('/cache_clear', function () {
    Artisan::call("route:clear");
    Artisan::call("route:cache");
    Artisan::call("view:clear");
    Artisan::call("config:cache");
    Artisan::call("optimize");

    return 'Cache borrada correctamente<br/><a href="' . url("/") . '">Volver al inicio<a>';
});

// LOGIN
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

// CONFIGURACIÓN
Route::get('/configuracion/getConfiguracion', [ConfiguracionController::class, 'getConfiguracion']);

Route::middleware(['auth'])->group(function () {
    Route::post('/configuracion/update', [ConfiguracionController::class, 'update']);

    Route::prefix('admin')->group(function () {
        // Usuarios
        Route::post('usuarios/updatePassword/{usuario}', [UserController::class, 'updatePassword']);
        Route::get('usuarios/getUsuarioTipo', [UserController::class, 'getUsuarioTipo']);
        Route::get('usuarios/getUsuario/{usuario}', [UserController::class, 'getUsuario']);
        Route::patch('usuarios/asignarConfiguracion/{usuario}', [UserController::class, 'asignarConfiguracion']);
        Route::get('usuarios/userActual', [UserController::class, 'userActual']);
        Route::get('usuarios/getInfoBox', [UserController::class, 'getInfoBox']);
        Route::get('usuarios/getPermisos/{usuario}', [UserController::class, 'getPermisos']);
        Route::get('usuarios/getEncargadosRepresentantes', [UserController::class, 'getEncargadosRepresentantes']);
        Route::post('usuarios/actualizaContrasenia/{usuario}', [UserController::class, 'actualizaContrasenia']);
        Route::post('usuarios/actualizaFoto/{usuario}', [UserController::class, 'actualizaFoto']);
        Route::resource('usuarios', UserController::class)->only([
            'index', 'store', 'update', 'destroy', 'show'
        ]);

        // UNIDADS
        Route::resource('unidads', UnidadController::class)->only([
            'index', 'store', 'update', 'destroy', 'show'
        ]);

        // CONDUCTORS
        Route::resource('conductors', ConductorController::class)->only([
            'index', 'store', 'update', 'destroy', 'show'
        ]);

        // VEHICULOS
        Route::resource('vehiculos', VehiculoController::class)->only([
            'index', 'store', 'update', 'destroy', 'show'
        ]);

        // UNIDAD SOLICITANTE
        Route::resource('unidad_solicitantes', UnidadSolicitanteController::class)->only([
            'index', 'store', 'update', 'destroy', 'show'
        ]);

        // SOLICITUD COMBUSTIBLE
        Route::resource('solicitud_combustibles', SolicitudCombustibleController::class)->only([
            'index', 'store', 'update', 'destroy', 'show'
        ]);

        // RECORRIDO VIAJES
        Route::resource('recorrido_viajes', RecorridoViajeController::class)->only([
            'index', 'store', 'update', 'destroy', 'show'
        ]);

        // REPORTES
        Route::post('reportes/usuarios', [ReporteController::class, 'usuarios']);
        Route::post('reportes/solicitud_unidad', [ReporteController::class, 'solicitud_unidad']);
        Route::post('reportes/cantidad_combustible_unidad', [ReporteController::class, 'cantidad_combustible_unidad']);
        Route::post('reportes/cantidad_viajes_conductor', [ReporteController::class, 'cantidad_viajes_conductor']);
        Route::post('reportes/cantidad_combustible_conductor', [ReporteController::class, 'cantidad_combustible_conductor']);
        Route::post('reportes/cantidad_viajes_unidad', [ReporteController::class, 'cantidad_viajes_unidad']);
        Route::post('reportes/g_cantidad_combustible_unidad', [ReporteController::class, 'g_cantidad_combustible_unidad']);
    });
});

// PORTAL
Route::get('/{optional?}', function () {
    return view('app');
})->name('base_path')->where('optional', '.*');
