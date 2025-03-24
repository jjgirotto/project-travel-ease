<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orcamento;
use App\Models\PacoteViagem;
use Exception;
use Illuminate\Support\Facades\Log;


class PacoteViagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacoteViagem = PacoteViagem::with('orcamento')->get();
        return view("pacoteViagens.index", compact('pacoteViagem'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orcamentos = Orcamento::all();
        return view("pacoteViagens.create", compact("orcamentos"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            PacoteViagem::create($request->all());
            return redirect()->route('pacoteViagens.index')->with('sucesso', 'Pacote criado com sucesso!');
        } catch (Exception $e) {
            Log::error("Erro ao criar o pacote de viagem: " . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route('pacoteViagens.index')->with('erro', 'Erro ao criar o pacote de viagem!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
