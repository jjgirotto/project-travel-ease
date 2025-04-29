@extends('layout')

@section('principal')
    <h1>Pacotes de Viagens</h1>

    @if(Auth::user()->role === 'ADM')
    <a class="btn btn-primary" href="/pacoteViagens/create">Novo Pacote de Viagem</a>]
    @endif

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
                <th>Passeios</th>
                <th>Restaurantes</th>
                <th>Viagem</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pacoteViagens as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->passeios }}</td>
                    <td>{{ $p->restaurantes }}</td>
                    <td>{{ $p->viagem->orcamento->origem }} x {{ $p->viagem->orcamento->destino }}: {{ $p->viagem->orcamento->cliente->nome }} - CPF: {{ $p->viagem->orcamento->cliente->cpf }}</td>
                    <td>
                        @if(Auth::user()->role === 'ADM')
                        <a href="/pacoteViagens/{{ $p->id }}/edit/" class="btn btn-warning">Editar</a>
                        @endif
                        <a href="/pacoteViagens/{{ $p->id }}" class="btn btn-info">Consultar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection