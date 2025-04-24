@extends('layout')

@section('principal')

    <h1>Consultar Orçamento</h1>
    
    <form method="post" action="/orcamentos/{{ $orcamento->id }}">
        @csrf
        @method('DELETE')

        <div class="mb-3">
            <label for="origem" class="form-label">Origem:</label>
            <input type="text" id="origem" name="origem" value = "{{ $orcamento->origem }}" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label for="destino" class="form-label">Destino:</label>
            <input type="text" id="destino" name="destino" value = "{{ $orcamento->destino }}" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label for="estadia" class="form-label">Quantidade de dias de estadia:</label>
            <input type="number" id="estadia" name="estadia" value = "{{ $orcamento->estadia}}" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label for="viajantes" class="form-label">Quantidade de viajantes:</label>
            <input type="number" id="viajantes" name="viajantes" value = "{{ $orcamento->viajantes }}" class="form-control" disabled>
        </div>

    <div class="mb-3">
        <label for="acomodacao" class="form-label">Precisa de acomodação?</label>
        <input type="checkbox" id="acomodacao" name="acomodacao" class="form-check-input" disabled value="1" {{ $orcamento->acomodacao ? 'checked' : '' }}>
    </div>
        
        <div class="mb-3">
            <label for="preferencia" class="form-label">Preferência:</label>
            <input type="text" id="preferencia" name="preferencia" value = "{{ $orcamento->preferencia }}" class="form-control" disabled>
        </div>
        @if(Auth::user()->role === 'ADM')
        <div class="mb-3">
            <label for="qtdeMilhas" class="form-label">Quantidade de milhas:</label>
            <input type="number" id="qtdeMilhas" name="qtdeMilhas" value = "{{ $orcamento->qtdeMilhas }}" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label for="valorMilhas" class="form-label">Valor de milhas:</label>
            <input type="number" id="valorMilhas" name="valorMilhas" step="0.01" value = "{{ $orcamento->valorMilhas }}" class="form-control" disabled>
        </div>
        @endif
        <div class="mb-3">
            <label for="valorTotal" class="form-label">Valor total:</label>
            <input type="number" id="valorTotal" name="valorTotal" step="0.01" value = "{{ $orcamento->valorTotal }}" class="form-control" disabled>
        </div>

    <div class="mb-3">
        <label for="escolhido" class="form-label">Orçamento escolhido:</label>
        <input type="checkbox" id="escolhido" name="escolhido" class="form-check-input" value="1" {{ $orcamento->escolhido ? 'checked' : '' }} disabled>
    </div>

        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente: </label>
            <select id="cliente_id" name="cliente_id" class="form-select" disabled>
                @foreach ($clientes as $c)
                    <option value="{{ $c->id }}" {{ $orcamento->cliente_id == $c->id ? "selected" : ""}}>
                        {{ $c->nome }} - CPF: {{ $c->cpf }} 
                    </option>
                @endforeach
            </select>
        </div>
        @if(Auth::user()->role === 'ADM')
        <button type="submit" class="btn btn-danger">Excluir</button>
        <a href="/orcamentos" class="btn btn-primary">Cancelar</a>
        @endif
    </form>
            
@endsection