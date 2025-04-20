<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrcamentoController;
use App\Http\Controllers\PacoteViagemController;
use App\Http\Controllers\ViagemController;
use App\Http\Controllers\PassagemController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleAdmMiddleware;
use App\Http\Middleware\RoleCliMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

//rotas de login
Route::get('/login', [AuthController::class, 'showFormLogin'])->name('login'); 
Route::post('/login', [AuthController::class, 'login']);

//middleware - protege as rotas
Route::middleware("auth")->group(function(){

    //rota de logout - acessível a ambos os tipos de usuário
    Route::post('/logout', [AuthController::class, 'logout']);


    //rotas das cruds - acessíveis ao usuário ADM
    Route::middleware([RoleAdmMiddleware::class])->group(function (){ 
        Route::resource("clientes", ClienteController::class);
        Route::resource("orcamentos", OrcamentoController::class);
        Route::resource("viagens", ViagemController::class);
        Route::resource("pacoteViagens", PacoteViagemController::class);
        Route::resource("passagens", PassagemController::class);
        Route::get('/home-adm', function() {
            return view("home-adm");
        });
    });

    //rota acessível ao usuário CLI - somente a página home
    Route::middleware([RoleCliMiddleware::class])->group(function (){ 
        Route::get('/home-cli', function() {
            return view("home-cli");
        });
    });
   
});