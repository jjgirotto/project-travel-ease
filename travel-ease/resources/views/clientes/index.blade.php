@extends('layout')

@section('principal')

    <h1>Clientes</h1>

    @if(auth()->user()->role === 'CLI')
        <a class="btn btn-primary" href="/clientes/create">Novo Cliente</a>
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
                <th>Nome do Cliente</th>
                <th>Email</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $c)
                @if(auth()->user()->role === 'ADM' || auth()->user()->id === $c->user_id)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->nome }}</td>
                    <td>{{ $c->user->email }}</td>
                    <td>{{ $c->endereco }}</td>
                    <td>{{ $c->telefone }}</td>
                    <td>
                        @if(auth()->user()->role === 'ADM')
                            <a href="/clientes/{{ $c->id }}" class="btn btn-info">Consultar</a>
                        @elseif(auth()->user()->id === $c->user_id)
                            <a href="/clientes/{{ $c->id }}/edit" class="btn btn-warning">Editar</a>
                        @endif
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    @endsection