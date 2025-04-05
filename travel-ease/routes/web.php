<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrcamentoController;
use App\Http\Controllers\PacoteViagemController;
use App\Http\Controllers\ViagemController;
use App\Http\Controllers\PassagemController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource("clientes", ClienteController::class);
Route::resource("orcamentos", OrcamentoController::class);
Route::resource("viagens", ViagemController::class);
Route::resource("pacoteViagens", PacoteViagemController::class);
Route::resource("passagens", PassagemController::class);