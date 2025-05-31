<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viagem;
use Barryvdh\DomPDF\Facade\Pdf;


class ItinerarioController extends Controller
{
    public function emitir(Viagem $viagem)
    {
        $viagem->load('orcamento.cliente', 'passagem', 'pacote');

        return view('itinerario', compact('viagem'));
    }

    public function gerarPdf(Viagem $viagem)
    {
        $viagem->load('orcamento.cliente', 'passagem', 'pacote');
        $pdf = PDF::loadView('itinerario-pdf', compact('viagem'))
                ->setPaper('a4');
        return $pdf->download('itinerario_viagem.pdf');
    }  
}
