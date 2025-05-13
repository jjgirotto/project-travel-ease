@extends('layout')

@section('principal')
 
    <h2><i class="bi bi-search"></i> Consultar Viagens</h2>
     
     <form method="post" action="/viagens/{{ $viagem->id }}">
        @csrf
        @method('DELETE')                 
        <div class="mb-3">
            <label for="pagamento" class="form-label">Forma de Pagamento:</label>
            <select id="pagamento" name="pagamento" class="form-select" disabled>
                <option value="Débito" {{ $viagem->pagamento == "Débito" ? "selected" : "" }}>Débito</option>
                <option value="Pix" {{ $viagem->pagamento == "Pix" ? "selected" : "" }}>Pix</option>
                <option value="Crédito" {{ $viagem->pagamento == "Crédito" ? "selected" : "" }}>Crédito</option>
            </select>
        </div>
 
         <div class="mb-3">
             <label for="orcamento_id" class="form-label">Orçamento: </label>
             <select id="orcamento_id" name="orcamento_id" class="form-select" disabled>
                 @foreach ($orcamentos as $o)
                     <option value="{{ $o->id }}" {{ $viagem->orcamento_id == $o->id ? "selected" : "" }}>
                         {{ $o->origem }} x {{ $o->destino }}: {{ $o->cliente->nome }} - CPF: {{ $o->cliente->cpf }}
                     </option>
                 @endforeach
             </select>
         </div>
         @if(Auth::user()->role === 'ADM')
        <button type="submit" class="btn btn-danger mb-3" onclick="return confirm('Tem certeza que deseja excluir esta viagem?')">
            <i class="bi bi-trash"></i> Excluir
        </button>
         <a href="/viagens" class="btn btn-primary mb-3">Cancelar</a>
         @endif
     </form>
             
@endsection