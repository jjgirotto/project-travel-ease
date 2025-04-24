<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Orcamento;
use Exception;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrcamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'ADM') {
            $orcamentos = Orcamento::with('cliente')->get();
        } else {
            $cliente = Cliente::where('user_id', Auth::id())->first();
            $orcamentos = Orcamento::with('cliente')
                ->where('cliente_id', $cliente->id)
                ->get();
        }
    
        return view('orcamentos.index', compact('orcamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $cliente = null;
        if (Auth::user()->role === 'CLI') {
            $cliente = Cliente::where('user_id', Auth::id())->first();
        }
        return view("orcamentos.create", compact("clientes", "cliente"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $request->merge([
                'acomodacao' => $request->has('acomodacao') ? 1 : 0,
                'escolhido' => $request->has('escolhido') ? 1 : 0,
            ]);

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
        $orcamento = Orcamento::findOrFail($id); 
        $clientes = Cliente::all(); 
        return view("orcamentos.show", compact('orcamento','clientes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $orcamento = Orcamento::findOrFail($id); 
        $clientes = Cliente::all(); 
        return view("orcamentos.edit", compact('orcamento','clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $orcamento = Orcamento::findOrFail($id);
            $orcamento->update($request->all());
            return redirect()->route('orcamentos.index')->with('sucesso', 'Orçamento alterado com sucesso!');
        } catch (Exception $e) {
            Log::error("erro ao atualizar o orcamento: ".$e->getMessage(), [
                'stack' => $e->getTraceAsString(),
	            'orcamento_id' => $id,
	            'request' => $request->all()
            ]);
            return redirect()->route('orcamentos.index')->with('erro','Erro ao editar!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $orcamento = Orcamento::findOrFail($id);
            $orcamento->delete();
            return redirect()->route('orcamentos.index')->with('sucesso', 'Orcamento excluído com sucesso!');
        } catch (Exception $e) {
            Log::error("erro ao excluir o orcamento: ".$e->getMessage(), [
                'stack' => $e->getTraceAsString(),
	            'orcamento_id' => $id
            ]);
            return redirect()->route('orcamentos.index')->with('erro','Erro ao excluir!');
        }
    }
}
