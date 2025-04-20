@extends('layout')

@section('principal')
    <h1>Passagens Emitidas</h1>

    <a class="btn btn-primary" href="/passagens/create">Nova Passagem</a>

    @if (session('erro'))
        <div class="alert alert-danger">
            {{ session('erro') }}
        </div>
    @endif
    @if (session('sucesso'))
        <div class="alert alert-success">
            {{ session('sucesso') }}
        </div>
    @endif

    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Embarque</th>
                <th>Desembarque</th>
                <th>Viagem</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($passagem as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->checkin }}</td>
                    <td>{{ $p->checkout }}</td>
                    <td>{{ $p->aeroOrigem }}</td>
                    <td>{{ $p->aeroDestino }}</td>
                    <td>{{ $p->viagem->orcamento->origem }} x {{ $p->viagem->orcamento->destino }}: {{ $p->viagem->orcamento->cliente->nome }} - CPF: {{ $p->viagem->orcamento->cliente->cpf }}</td>
                    <td>
                        <a href="/passagens/{{ $p->id }}/edit" class="btn btn-warning">Editar</a>
                        <a href="/passagens/{{ $p->id }}" class="btn btn-info">Consultar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection