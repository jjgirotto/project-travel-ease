<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::with('user')->get();
        return view("clientes.index", compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view("clientes.create", compact("users"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Cliente::create($request->all());
            return redirect()->route('clientes.index')->with('sucesso', 'Cliente inserido com sucesso!');
        } catch (Exception $e) {
            Log::error("Erro ao criar o cliente: " . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route('clientes.index')->with('erro', 'Erro ao criar o cliente!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $users = User::all();
        return view("clientes.show", compact('cliente', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $users = User::all();
        return view("clientes.edit", compact('cliente', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->update($request->all());
            return redirect()->route('clientes.index')->with('sucesso', 'Cliente alterado com sucesso!');
        } catch (Exception $e) {
            Log::error("erro ao atualizar o cliente: ".$e->getMessage(), [
                'stack' => $e->getTraceAsString(),
	            'cliente_id' => $id,
	            'request' => $request->all()
            ]);
            return redirect()->route('clientes.index')->with('erro','Erro ao editar!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();
            return redirect()->route('clientes.index')->with('sucesso', 'Cliente excluído com sucesso!');
        } catch (Exception $e) {
            Log::error("erro ao excluir o cliente: ".$e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'cliente_id' => $id
            ]);
            return redirect()->route('produtos.index')->with('erro','Erro ao excluir!');
        }
    }
}
