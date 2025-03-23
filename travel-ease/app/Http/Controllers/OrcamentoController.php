<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Orcamento;
use Exception;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class OrcamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orcamentos = Orcamento::with('cliente')->get();
        return view("orcamentos.index", compact('orcamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        return view("orcamentos.create", compact("clientes"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Orcamento::create($request->all());
            return redirect()->route('orcamentos.index')->with('sucesso', 'Orçamento inserido com sucesso!');
        } catch (Exception $e) {
            Log::error("Erro ao criar o orçamento: " . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route('orcamentos.index')->with('erro', 'Erro ao criar o orçamento!');
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
