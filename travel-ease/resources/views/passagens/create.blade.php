@extends('layout')

@section('principal')
    <h1>Nova Passagem</h1>

    <form method="post" action="/passagens" >
    @csrf  
    
    <div class="row mt-3">
        <div class="col-3">
            <label for="checkin" class="form-label">Data de Check-in:</label>
            <input type="date" name="checkin" id="checkin" class="form-control">
        </div>
        <div class="col-3">
            <label for="checkout" class="form-label">Data de Check-out:</label>
            <input type="date" name="checkout" id="checkout" class="form-control">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-5">
            <label for="aeroOrigem" class="form-label">Local de Embarque:</label>
            <input type="text" name="aeroOrigem" id="aeroOrigem" class="form-control">
        </div>
        <div class="col-5">
            <label for="aeroDestino" class="form-label">Local de Desembarque:</label>
            <input type="text" name="aeroDestino" id="aeroDestino" class="form-control">
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <label for="viagem_id" class="form-label">Viagem: </label>
        <select name="viagem_id" id="viagem_id" class="form-select" required="">
            @foreach($viagens as $v)
                <option value="{{ $v->id }}">
                    {{ $v->orcamento->origem }} x {{ $v->orcamento->destino }}: {{ $v->orcamento->cliente->nome }} - CPF: {{ $v->orcamento->cliente->cpf }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Emitir Passagem</button>

    </form>
@endsection