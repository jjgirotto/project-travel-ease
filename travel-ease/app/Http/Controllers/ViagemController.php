<?php

namespace App\Http\Controllers;
use App\Models\Orcamento;
use App\Models\Viagem;
use Exception;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class ViagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viagens = Viagem::with('orcamento')->get();
        return view("viagens.index", compact('viagens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orcamentos = Orcamento::all();
        return view("viagens.create", compact("orcamentos"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Viagem::create($request->all());
            return redirect()->route('viagens.index')->with('sucesso', 'Viagem inserida com sucesso!');
        } catch (Exception $e) {
            Log::error("Erro ao criar a viagem: " . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route('viagens.index')->with('erro', 'Erro ao criar a viagem!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $viagem = Viagem::findOrFail($id);
        $orcamentos = Orcamento::all();
        return view("viagens.show", compact('viagem', 'orcamentos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $viagem = Viagem::findOrFail($id);
        $orcamentos = Orcamento::all();
        return view("viagens.edit", compact('viagem', 'orcamentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $viagem = Viagem::findOrFail($id);
            $viagem->update($request->all());
            return redirect()->route('viagens.index')->with('sucesso', 'Viagem alterada com sucesso!');
        } catch (Exception $e) {
            Log::error("Erro ao atualizar a viagem: ".$e->getMessage(), [
                'stack' => $e->getTraceAsString(),
	            'viagem_id' => $id,
	            'request' => $request->all()
            ]);
            return redirect()->route('viagens.index')->with('erro','Erro ao editar!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $viagem = Viagem::findOrFail($id);
            $viagem->delete();
            return redirect()->route('viagens.index')->with('sucesso', 'Viagem excluída com sucesso!');
        } catch (Exception $e) {
            Log::error("Erro ao excluir a viagem: ".$e->getMessage(), [
                'stack' => $e->getTraceAsString(),
	            'viagem_id' => $id,
            ]);
            return redirect()->route('viagens.index')->with('erro','Erro ao excluir!');
        }
    }
}
