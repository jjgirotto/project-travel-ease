@extends('layout')

@section('principal')
    <a href="{{ route('passagens.index') }}" class="btn btn-outline-secondary mb-4"><i class="bi bi-arrow-left"></i> Voltar</a>
    <h2><i class="bi bi-pencil-square"></i> Editar Passagem</h2>

    <form action="/passagens/{{ $passagem->id }}" method="post">
    @csrf  
    @method('PUT')
    <div class="row mt-3">
        <div class="col-3">
            <label for="checkin" class="form-label">Data de Check-in:</label>
            <input type="date" name="checkin" id="checkin" value="{{ $passagem->checkin }}" class="form-control">
        </div>
        <div class="col-3">
            <label for="checkout" class="form-label">Data de Check-out:</label>
            <input type="date" name="checkout" id="checkout" value="{{ $passagem->checkout }}" class="form-control">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-5">
            <label for="aeroOrigem" class="form-label">Local de Embarque:</label>
            <input type="text" name="aeroOrigem" id="aeroOrigem" value="{{ $passagem->aeroOrigem }}" class="form-control">
        </div>
        <div class="col-5">
            <label for="aeroDestino" class="form-label">Local de Desembarque:</label>
            <input type="text" name="aeroDestino" id="aeroDestino" value="{{ $passagem->aeroDestino }}" class="form-control">
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <div class="col-7">
        <label for="viagem_id" class="form-label">Viagem: </label>
        <select name="viagem_id" id="viagem_id" class="form-select" required="">
            @foreach($viagens as $v)
                <option value="{{ $v->id }}" {{ $passagem->viagem_id == $v->id ? "selected" : "" }}>
                    {{ $v->orcamento->origem }} x {{ $v->orcamento->destino }}: {{ $v->orcamento->cliente->nome }} - CPF: {{ $v->orcamento->cliente->cpf }}
                </option>
            @endforeach
        </select>
        </div>
    </div>

    <button type="submit" class="btn btn-primary mb-3">
        <i class="bi bi-send-check"></i> Enviar
    </button>

    </form>
@endsection