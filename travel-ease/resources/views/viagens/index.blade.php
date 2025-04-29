@extends('layout')

@section('principal')

    <h1>Viagens</h1>

    @if(auth()->user()->role === 'ADM')
    <a class="btn btn-primary" href="/viagens/create">Nova Viagem</a>
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
                <th>Forma de pagamento</th>
                <th>Orçamento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($viagens as $v)
                <tr>
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->pagamento }}</td>
                    <td>{{ $v->orcamento->origem }} x {{ $v->orcamento->destino }}: {{ $v->orcamento->cliente->nome }} - CPF: {{ $v->orcamento->cliente->cpf }}</td>
                    <td>
                        @if(auth()->user()->role === 'ADM')
                        <a href="/viagens/{{ $v->id }}/edit" class="btn btn-warning">Editar</a>
                        @endif
                        <a href="/viagens/{{ $v->id }}" class="btn btn-info">Consultar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection