<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrcamentoController;
use App\Http\Controllers\ViagemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource("clientes", ClienteController::class);
Route::resource("orcamentos", OrcamentoController::class);
Route::resource("viagens", ViagemController::class);