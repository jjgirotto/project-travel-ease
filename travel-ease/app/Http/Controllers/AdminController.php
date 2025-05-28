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

        $handle = fopen('php://temp', 'r+');
        fwrite($handle, "\xEF\xBB\xBF");

        fputcsv($handle, ['=== VIAGENS NO ÚLTIMO MÊS ===']);
        fputcsv($handle, ['Cliente', 'Destino', 'Check-in']);
        foreach ($passagens as $p) {
            $clienteNome = $p->viagem->orcamento->cliente->nome ?? '-';
            $destino = $p->viagem->orcamento->destino ?? '-';
            $checkin = Carbon::parse($p->checkin)->format('d/m/Y');
            fputcsv($handle, [$clienteNome, $destino, $checkin]);
        }

        fputcsv($handle, []);

        fputcsv($handle, ['=== ORÇAMENTOS NO ÚLTIMO MÊS ===']);
        fputcsv($handle, ['Cliente', 'Destino', 'Data']);
        foreach ($orcamentos as $o) {
            fputcsv($handle, [$o->cliente->nome, $o->destino, $o->created_at->format('d/m/Y')]);
        }

        fputcsv($handle, []);

        fputcsv($handle, ['=== NOVOS CLIENTES NO ÚLTIMO MÊS ===']);
        fputcsv($handle, ['Nome', 'Email', 'Data de Cadastro']);
        foreach ($clientes as $c) {
            fputcsv($handle, [$c->nome, $c->user->email, $c->created_at->format('d/m/Y')]);
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="relatorio_acompanhamento.csv"',
        ]);
    }
}
