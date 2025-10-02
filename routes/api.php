<?php

use App\Http\Controllers\CarritoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('recibir-pagos', [CarritoController::class, 'recibirPagos']);
