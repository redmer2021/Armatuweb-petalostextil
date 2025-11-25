<?php

use App\Http\Controllers\CarritoController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pginicio');
});

Route::get('Producto/{id}', [CatalogoController::class, 'Producto'])->name('Producto');

Route::get('activar-cta/{token}', [UsuariosController::class, 'activar_cuenta']);
Route::get('recuperar-cta/{token}', [UsuariosController::class, 'recuperar_cta']);

Route::get('logAdmin', [UsuariosController::class, 'logAdmin']);
Route::get('panelDeControl', [UsuariosController::class, 'panelDeControl']);

Route::get('politicas-de-cambio', [LinksController::class, 'PoliticasDeCambio']) ->name('politicas-de-cambio');
Route::get('preguntas-frecuentes', [LinksController::class, 'PreguntasFrecuentes']) ->name('preguntas-frecuentes');
Route::get('finalizar-compra', [CarritoController::class, 'finalizarCompra']) ->name('finalizar-compra');

Route::get('/clear-cache/{key}', function ($key) {
    if ($key !== env('CACHE_KEY')) {
        abort(403, 'Acceso denegado');
    }

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');

    return "✅ Caché limpiada correctamente.";
});