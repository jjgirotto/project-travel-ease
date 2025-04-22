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
        if (auth()->user()->role === 'CLI') {
            $cliente = auth()->user()->cliente;
            $clientes = $cliente ? [$cliente] : [];
        } else {
            $clientes = Cliente::with('user')->get(); // para ADM
        }
        return view("clientes.index", compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role === 'CLI') {
            return view('clientes.create');
        }
        
        $users = User::all();
        return view("clientes.create", compact("users"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $dados = $request->all();

            if (auth()->user()->role === 'CLI') {
                $dados['user_id'] = auth()->id(); // Garante que só crie pra si
            }
    
            Cliente::create($dados);
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
        if (auth()->user()->role !== 'ADM') {
            abort(403, 'Acesso negado. Somente administradores podem consultar.');
        }
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
        if (auth()->user()->role === 'CLI' && auth()->id() !== $cliente->user_id) {
            abort(403, 'Acesso negado');
        }
        return view("clientes.edit", compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            if (auth()->user()->role === 'CLI' && auth()->id() !== $cliente->user_id) {
                abort(403, 'Acesso negado');
            }
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
        if (auth()->user()->role !== 'ADM') {
            abort(403, 'Acesso negado. Apenas administradores podem excluir clientes.');
        }
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
