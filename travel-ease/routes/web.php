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
        Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
        Route::get('/clientes/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');
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
        Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    
        // Rota para criar cliente (permitido para o cliente logado)
        Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
        Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
    
        // Rota para editar cliente (permitido para o cliente logado editar seus próprios dados)
        Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
        Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
    });
   
});