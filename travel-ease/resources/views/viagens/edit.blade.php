@extends('layout')

@section('principal')
    <a href="{{ route('viagens.index') }}" class="btn btn-outline-secondary mb-4"><i class="bi bi-arrow-left"></i> Voltar</a>
 
     <h2><i class="bi bi-pencil-square"></i> Editar Viagem</h2>
     
     <form method="post" action="/viagens/{{ $viagem->id }}">
        @csrf
        @method('PUT')                 
        <div class="mb-3">
            <label for="pagamento" class="form-label">Forma de Pagamento:</label>
            <select id="pagamento" name="pagamento" class="form-select" required>
                <option value="Débito" {{ $viagem->pagamento == "Débito" ? "selected" : "" }}>Débito</option>
                <option value="Pix" {{ $viagem->pagamento == "Pix" ? "selected" : "" }}>Pix</option>
                <option value="Crédito" {{ $viagem->pagamento == "Crédito" ? "selected" : "" }}>Crédito</option>
            </select>
        </div>
 
         <div class="mb-3">
             <label for="orcamento_id" class="form-label">Orçamento: </label>
             <select id="orcamento_id" name="orcamento_id" class="form-select" required="">
                 @foreach ($orcamentos as $o)
                     <option value="{{ $o->id }}" {{ $viagem->orcamento_id == $o->id ? "selected" : "" }}>
                         {{ $o->origem }} x {{ $o->destino }}: {{ $o->cliente->nome }} - CPF: {{ $o->cliente->cpf }}
                     </option>
                 @endforeach
             </select>
         </div>
 
         <button type="submit" class="btn btn-primary mb-3">
            <i class="bi bi-send-check"></i> Enviar
        </button>
     </form>
             
@endsection