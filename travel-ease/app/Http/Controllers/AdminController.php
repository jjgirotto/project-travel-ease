<?php

namespace App\Http\Controllers;

use App\Mail\AvisoViagemSemana;
use App\Models\Cliente;
use App\Models\Orcamento;
use App\Models\Passagem;
use App\Models\Viagem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

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
            ->with(['viagem.orcamento.cliente'])  
            ->orderBy('checkin')
            ->take(5)
            ->get(),
            'orcamentos' => Orcamento::latest()->take(5)->get(),
            'clientesRecentes' => Cliente::latest()->take(5)->get(),
            'destinosFrequentes' => Orcamento::select(DB::raw('LOWER(TRIM(destino)) as destino_normalizado'), DB::raw('count(*) as total'))
            ->whereNotNull('destino')
            ->where('destino', '<>', '')
            ->groupBy('destino_normalizado')
            ->orderByDesc('total')
            ->get()
        ]);
    }

    public function exportarRelatorio()
    {
        $inicioMes = Carbon::now()->subMonth();

        $passagens = Passagem::with('viagem.orcamento.cliente')
            ->where('checkin', '>=', $inicioMes)
            ->get();

        $orcamentos = Orcamento::with('cliente')
            ->where('created_at', '>=', $inicioMes)
            ->get();

        $clientes = Cliente::where('created_at', '>=', $inicioMes)->get();

        $csv = "=== VIAGENS NO ULTIMO MES ===\n";
        $csv .= "Cliente,Destino,Check-in\n";
        foreach ($passagens as $p) {
            $clienteNome = $p->viagem->orcamento->cliente->nome ?? '-';
            $destino = $p->viagem->orcamento->destino ?? '-';
            $checkin = Carbon::parse($p->checkin)->format('d/m/Y');
            $csv .= "{$clienteNome},{$destino},{$checkin}\n";
        }

        $csv .= "\n=== ORÇAMENTOS NO ULTIMO MES ===\n";
        $csv .= "Cliente,Destino,Data\n";
        foreach ($orcamentos as $o) {
            $csv .= "{$o->cliente->nome},{$o->destino}," . $o->created_at->format('d/m/Y') . "\n";
        }

        $csv .= "\n=== NOVOS CLIENTES NO ULTIMO MES ===\n";
        $csv .= "Nome,Email,Data de Cadastro\n";
        foreach ($clientes as $c) {
            $csv .= "{$c->nome},{$c->user->email}," . $c->created_at->format('d/m/Y') . "\n";
        }

        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="relatorio_acompanhamento.csv"',
        ]);
    }
}
