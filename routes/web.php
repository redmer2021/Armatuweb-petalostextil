<?php

use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pginicio');
});

Route::get('Producto/{id}', [CatalogoController::class, 'Producto'])->name('Producto');

Route::get('activar-cta/{token}', [UsuariosController::class, 'activar_cuenta']);
Route::get('recuperar-cta/{token}', [UsuariosController::class, 'recuperar_cta']);


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