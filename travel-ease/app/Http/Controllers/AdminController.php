<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Orcamento;
use App\Models\Passagem;
use App\Models\Viagem;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function home()
{
    return view('home-adm', [
        'viagensAgendadas' => Viagem::count(),
        'orcamentosMes' => Orcamento::whereMonth('created_at', now()->month)->count(),
        'destinosAtivos' => Orcamento::distinct('destino')->count('destino'),
        'clientesMes' => Cliente::whereMonth('created_at', now()->month)->count(),
        'viagensProximas' => Passagem::whereDate('checkin', '>=', now())
            ->with(['viagem', 'cliente'])
            ->orderBy('checkin')
            ->take(5)
            ->get(),
        'orcamentos' => Orcamento::latest()->take(5)->get(),
        'clientesRecentes' => Cliente::latest()->take(5)->get(),
            'destinosFrequentes' => Orcamento::select('destino', DB::raw('count(*) as total'))
        ->groupBy('destino')
        ->orderByDesc('total')
        ->get()
    ]);
}
}
