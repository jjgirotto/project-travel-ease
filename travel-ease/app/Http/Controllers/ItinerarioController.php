<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viagem;
//use PDF; 

class ItinerarioController extends Controller
{
    public function emitir(Viagem $viagem)
    {
        $viagem->load('orcamento.cliente', 'passagem', 'pacote');

        return view('itinerario', compact('viagem'));
    }

    /*public function emitirPdf($id)
    {
        $viagem = Viagem::with([
            'orcamento.cliente', 
            'passagem', 
            'pacoteAtracoes.passeios', 
            'pacoteAtracoes.restaurantes'
        ])->findOrFail($id);

        $pdf = PDF::loadView('itinerarios.emitir_pdf', compact('viagem'));
        
        // baixa o PDF com nome customizado
        return $pdf->download("itinerario_viagem_{$viagem->id}.pdf");
    }*/
}
