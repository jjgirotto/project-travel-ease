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
