@extends('layout')

@section('principal')
 
     <h1>Nova Viagem</h1>
     
     <form method="post" action="/viagens">
         @csrf
                         
        <div class="mb-3">
            <label for="pagamento" class="form-label">Forma de Pagamento:</label>
            <select id="pagamento" name="pagamento" class="form-select" required>
                <option value="Débito">Débito</option>
                <option value="Pix">Pix</option>
                <option value="Crédito">Crédito</option>
            </select>
        </div>
 
         <div class="mb-3">
             <label for="orcamento_id" class="form-label">Orçamento: </label>
             <select id="orcamento_id" name="orcamento_id" class="form-select" required="">
                 @foreach ($orcamentos as $o)
                     <option value="{{ $o->id }}">
                         {{ $o->origem }} x {{ $o->destino }}: {{ $o->cliente->nome }} - CPF: {{ $o->cliente->cpf }}
                     </option>
                 @endforeach
             </select>
         </div>
 
         <button type="submit" class="btn btn-primary">Enviar</button>
     </form>
             
@endsection