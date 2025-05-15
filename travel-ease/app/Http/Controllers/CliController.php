<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Orcamento;
use App\Models\Viagem;
use App\Models\Passagem;
use Illuminate\Support\Facades\Auth;

class CliController extends Controller
{
    public function homeCliente()
    {
        $cliente = Auth::user()->cliente;

        if (!$cliente) {
            return redirect()->route('login')->with('erro', 'Cliente não encontrado.');
        }

        // Orçamentos em aberto
        $orcamentosAbertos = Orcamento::where('cliente_id', $cliente->id)
            ->where(function ($query) {
                $query->whereNull('escolhido')->orWhere('escolhido', 0);
            })
            ->get();

        // Viagens com passagem emitida
        $viagensProximas = Viagem::whereIn('orcamento_id', $orcamentosAbertos->pluck('id'))->get()
            ->filter(function ($viagem) {
                return $viagem->passagem; // viagem deve ter passagem
            });

        return view('home-cli', compact('orcamentosAbertos', 'viagensProximas'));
    }

}



