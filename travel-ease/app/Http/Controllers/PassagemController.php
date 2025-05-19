<?php

namespace App\Http\Controllers;

use App\Mail\AvisoViagemSemana;
use App\Models\Cliente;
use App\Models\Orcamento;
use Illuminate\Http\Request;
use App\Models\Viagem;
use App\Models\Passagem;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PassagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'ADM') {
            $passagens = Passagem::with('viagem')->get();
        } else {
            $cliente = Cliente::where('user_id', Auth::id())->first();
            $orcamentos = Orcamento::where('cliente_id', $cliente->id)->pluck('id');
            $viagens = Viagem::whereIn('orcamento_id', $orcamentos)->pluck('id');
            $passagens = Passagem::with('viagem')->whereIn('viagem_id', $viagens)->get();
        }
        return view('passagens.index', compact('passagens'));
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
        $passagem = Passagem::with('viagem.orcamento')->findOrFail($id);
        $viagens = Viagem::with('orcamento')->get(); 
        return view("passagens.show", compact('passagem', 'viagens'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $passagem = Passagem::findOrFail($id);
        $viagens = Viagem::all();
        return view("passagens.edit", compact('passagem', 'viagens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $passagem = Passagem::findOrFail($id);
            $passagem->update($request->all());
            return redirect()->route('passagens.index')->with('sucesso', 'Passagem alterada com sucesso!');
        } catch (Exception $e) {
            Log::error("Erro ao atualizar a passagem: ".$e->getMessage(), [
                'stack' => $e->getTraceAsString(),
	            'passagem_id' => $id,
	            'request' => $request->all()
            ]);
            return redirect()->route('passagens.index')->with('erro','Erro ao editar!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $passagem = Passagem::findOrFail($id);
            $passagem->delete();
            return redirect()->route('passagens.index')->with('sucesso', 'Passagem excluída com sucesso!');
        } catch (Exception $e) {
            Log::error("Erro ao excluir a passagem: ".$e->getMessage(), [
                'stack' => $e->getTraceAsString(),
	            'passagem_id' => $id
            ]);
            return redirect()->route('passagens.index')->with('erro','Erro ao excluir!');
        }
    }

    public function formAviso($id)
    {
        $passagem = Passagem::with('viagem.orcamento.cliente')->findOrFail($id);
        return view('passagens.aviso', compact('passagem'));
    }

    public function enviarAviso(Request $request, $id)
    {
        $pdfPath = null;
        
        if ($request->hasFile('arquivo')) {
            $request->validate([
                'arquivo' => 'mimes:pdf|max:2048',
            ]);
            $file = $request->file('arquivo');
            $nomeArquivo = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('avisos', $nomeArquivo);
            $pdfPath = storage_path('app/private/' . $path);
        }

        $passagem = Passagem::with('viagem.orcamento.cliente.user')->findOrFail($id);
        $cliente = $passagem->viagem->orcamento->cliente;

        if (!$cliente || !$cliente->user || !$cliente->user->email) {
            return redirect()->route('passagens.index')->with('erro', 'Cliente ou usuário inválido, ou email não encontrado.');
        }

        $email = $cliente->user->email;
        $nome = $cliente->nome;
        $destino = $passagem->viagem->orcamento->destino;
        $checkin = $passagem->checkin;
        
        Mail::to($email)->send(new AvisoViagemSemana(
            $nome,
            $destino,
            $checkin,
            $pdfPath
        ));

        return redirect()->route('passagens.index')->with('sucesso', 'Aviso enviado com sucesso!');
    }

}
