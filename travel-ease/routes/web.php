<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrcamentoController;
use App\Http\Controllers\PacoteViagemController;
use App\Http\Controllers\ViagemController;
use App\Http\Controllers\PassagemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SobreController;
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

    //rotas create
    Route::get('/clientes/create', [ClienteController::class, 'create'])->middleware('role.adm')->name('clientes.create');
    Route::get('/orcamentos/create', [OrcamentoController::class, 'create'])->name('orcamentos.create');
    Route::get('/viagens/create', [ViagemController::class, 'create'])->middleware('role.adm')->name('viagens.create');
    Route::get('/pacoteViagens/create', [PacoteViagemController::class, 'create'])->middleware('role.adm')->name('pacoteViagens.create');
    Route::get('/passagens/create', [PassagemController::class, 'create'])->middleware('role.adm')->name('passagens.create');

    //rotas acessíveis a ambos os tipos de usuário
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/{c}', [ClienteController::class, 'show'])->name('clientes.show');
    
    Route::get('/orcamentos', [OrcamentoController::class, 'index'])->name('orcamentos.index');
    Route::get('/orcamentos/{o}', [OrcamentoController::class, 'show'])->name('orcamentos.show');
    Route::post('/orcamentos', [OrcamentoController::class, 'store'])->name('orcamentos.store');

    Route::get('/viagens', [ViagemController::class, 'index'])->name('viagens.index');
    Route::get('/viagens/{v}', [ViagemController::class, 'show'])->name('viagens.show');

    Route::get('/pacoteViagens', [PacoteViagemController::class, 'index'])->name('pacoteViagens.index');
    Route::get('/pacoteViagens/{p}', [PacoteViagemController::class, 'show'])->name('pacoteViagens.show');

    Route::get('/passagens', [PassagemController::class, 'index'])->name('passagens.index');
    Route::get('/passagens/{pa}', [PassagemController::class, 'show'])->name('passagens.show');
    
    //rotas das cruds - acessíveis ao usuário ADM
    Route::middleware([RoleAdmMiddleware::class])->group(function () {
        Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
        Route::get('/clientes/{c}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
        Route::put('/clientes/{c}', [ClienteController::class, 'update'])->name('clientes.update');
        Route::delete('/clientes/{c}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
    });

    Route::middleware([RoleAdmMiddleware::class])->group(function () {
        Route::get('/orcamentos/{o}/edit', [OrcamentoController::class, 'edit'])->name('orcamentos.edit');
        Route::put('/orcamentos/{o}', [OrcamentoController::class, 'update'])->name('orcamentos.update');
        Route::delete('/orcamentos/{o}', [OrcamentoController::class, 'destroy'])->name('orcamentos.destroy');
    });

    Route::middleware([RoleAdmMiddleware::class])->group(function () {
        Route::post('/viagens', [ViagemController::class, 'store'])->name('viagens.store');
        Route::get('/viagens/{v}/edit', [ViagemController::class, 'edit'])->name('viagens.edit');
        Route::put('/viagens/{v}', [ViagemController::class, 'update'])->name('viagens.update');
        Route::delete('/viagens/{v}', [ViagemController::class, 'destroy'])->name('viagens.destroy');
    });

    Route::middleware([RoleAdmMiddleware::class])->group(function () {
        Route::post('/pacoteViagens', [PacoteViagemController::class, 'store'])->name('pacoteViagens.store');
        Route::get('/pacoteViagens/{p}/edit', [PacoteViagemController::class, 'edit'])->name('pacoteViagens.edit');
        Route::put('/pacoteViagens/{p}', [PacoteViagemController::class, 'update'])->name('pacoteViagens.update');
        Route::delete('/pacoteViagens/{p}', [PacoteViagemController::class, 'destroy'])->name('pacoteViagens.destroy');
    });

    Route::middleware([RoleAdmMiddleware::class])->group(function () {
        Route::post('/passagens', [PassagemController::class, 'store'])->name('passagens.store');
        Route::get('/passagens/{pa}/edit', [PassagemController::class, 'edit'])->name('passagens.edit');
        Route::put('/passagens/{pa}', [PassagemController::class, 'update'])->name('passagens.update');
        Route::delete('/passagens/{pa}', [PassagemController::class, 'destroy'])->name('passagens.destroy');
    });

    Route::middleware([RoleAdmMiddleware::class])->group(function (){        
        Route::get('/home-adm', function() {
            return view("home-adm");
        });
    });

    //rota acessível somente ao usuário CLI - somente a página home
    Route::middleware([RoleCliMiddleware::class])->group(function (){ 
        Route::get('/home-cli', function() {
            return view("home-cli");
        });
        Route::get('/sobre', [PageController::class, 'sobre'])->name('sobre');
        Route::get('/contato', [PageController::class, 'contato'])->name('contato');
    });
   
});