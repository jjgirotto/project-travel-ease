<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viagem;
use App\Models\Passagem;
use Exception;
use Illuminate\Support\Facades\Log;

class PassagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $passagem = Passagem::with('viagem')->get();
        return view('passagens.index', compact('passagem'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $viagens = Viagem::all();
        return view('passagens.create', compact('viagens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Passagem::create($request->all());
            return redirect()->route('passagens.index')->with('sucesso', 'Passagem criada com sucesso!');
        } catch (Exception $e) {
            Log::error("Erro ao criar a passagem: " . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return redirect()->route('passagens.index')->with('erro', 'Erro ao criar a passagem!');
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
