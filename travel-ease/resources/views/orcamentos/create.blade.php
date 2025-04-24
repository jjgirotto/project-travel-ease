@extends('layout')

@section('principal')
 
     <h1>Novo Orçamento</h1>
     
     <form method="post" action="/orcamentos">
         @csrf
                         
         <div class="mb-3">
             <label for="origem" class="form-label">Origem:</label>
             <input type="text" id="origem" name="origem" class="form-control" required="">
         </div>

         <div class="mb-3">
             <label for="destino" class="form-label">Destino:</label>
             <input type="text" id="destino" name="destino" class="form-control" required="">
         </div>

         <div class="mb-3">
             <label for="estadia" class="form-label">Quantidade de dias de estadia:</label>
             <input type="number" id="estadia" name="estadia" class="form-control" required="">
         </div>

         <div class="mb-3">
             <label for="viajantes" class="form-label">Quantidade de viajantes:</label>
             <input type="number" id="viajantes" name="viajantes" class="form-control" required="">
         </div>

        <div class="mb-3">
            <label for="acomodacao" class="form-label">Precisa de acomodação?</label>
            <input type="checkbox" id="acomodacao" name="acomodacao" class="form-check-input">
        </div>
         
         <div class="mb-3">
             <label for="preferencia" class="form-label">Preferência:</label>
             <input type="text" id="preferencia" name="preferencia" class="form-control">
         </div>
         @if(auth()->user()->role === 'ADM')
         <div class="mb-3">
             <label for="qtdeMilhas" class="form-label">Quantidade de milhas:</label>
             <input type="number" id="qtdeMilhas" name="qtdeMilhas" class="form-control">
         </div>
        
         <div class="mb-3">
             <label for="valorMilhas" class="form-label">Valor de milhas:</label>
             <input type="number" id="valorMilhas" name="valorMilhas" step="0.01" class="form-control">
         </div>

         <div class="mb-3">
             <label for="valorTotal" class="form-label">Valor total:</label>
             <input type="number" id="valorTotal" name="valorTotal" step="0.01" class="form-control">
         </div>

        <div class="mb-3">
            <label for="escolhido" class="form-label">Orçamento escolhido:</label>
            <input type="checkbox" id="escolhido" name="escolhido" class="form-check-input">
        </div>
        
 
         <div class="mb-3">
             <label for="cliente_id" class="form-label">Cliente: </label>
             <select id="cliente_id" name="cliente_id" class="form-select" required="">
                 @foreach ($clientes as $c)
                     <option value="{{ $c->id }}">
                         {{ $c->nome }} - CPF: {{ $c->cpf }} 
                     </option>
                 @endforeach
             </select>
         </div>
         @endif
         @if(auth()->user()->role === 'CLI')
         <div class="mb-3">
            <label class="form-label">Cliente: </label>
            <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
            <input type="text" class="form-control" value="{{ $cliente->nome }} - CPF: {{ $cliente->cpf }}" readonly>
        </div>
         @endif
 
         <button type="submit" class="btn btn-primary">Enviar</button>
     </form>
             
@endsection