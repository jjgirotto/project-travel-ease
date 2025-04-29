@extends('layout')

@section('principal')
    <h1>Consultar Passagem</h1>

    <form action="/passagens/{{ $passagem->id }}" method="post">
    @csrf  
    @method('DELETE')
    <div class="row mt-3">
        <div class="col-3">
            <label for="checkin" class="form-label">Data de Check-in:</label>
            <input type="date" name="checkin" id="checkin" value="{{ $passagem->checkin }}" class="form-control" disabled>
        </div>
        <div class="col-3">
            <label for="checkout" class="form-label">Data de Check-out:</label>
            <input type="date" name="checkout" id="checkout" value="{{ $passagem->checkout }}" class="form-control" disabled>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-5">
            <label for="aeroOrigem" class="form-label">Local de Embarque:</label>
            <input type="text" name="aeroOrigem" id="aeroOrigem" value="{{ $passagem->aeroOrigem }}" class="form-control" disabled>
        </div>
        <div class="col-5">
            <label for="aeroDestino" class="form-label">Local de Desembarque:</label>
            <input type="text" name="aeroDestino" id="aeroDestino" value="{{ $passagem->aeroDestino }}" class="form-control" disabled>
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <label for="viagem_id" class="form-label">Viagem: </label>
        <select name="viagem_id" id="viagem_id" class="form-select" disabled>
            @foreach($viagens as $v)
                <option value="{{ $v->id }}" {{ $passagem->viagem_id == $v->id ? "selected" : "" }}>
                    {{ $v->orcamento->origem }} x {{ $v->orcamento->destino }}: {{ $v->orcamento->cliente->nome }} - CPF: {{ $v->orcamento->cliente->cpf }}
                </option>
            @endforeach
        </select>
    </div>

    @if(Auth::user()->role === 'ADM')
    <p>Deseja excluir o registro?</p>
    <button type="submit" class="btn btn-danger">Excluir</button>
    <a href="/passagens" class="btn btn-primary">Cancelar</a>
    @endif

    </form>
@endsection