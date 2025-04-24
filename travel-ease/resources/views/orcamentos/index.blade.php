@extends('layout')

@section('principal')
    <h1>Orçamentos</h1>

    <a class="btn btn-primary" href="/orcamentos/create">Novo Orçamento</a>
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
                <th>Origem</th>
                <th>Destino</th>
                <th>Estadia</th>
                <th>Viajantes</th>
                <th>Valor Total</th>
                <th>Cliente</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orcamentos as $o)
                <tr>
                    <td>{{ $o->id }}</td>
                    <td>{{ $o->origem }}</td>
                    <td>{{ $o->destino }}</td>
                    <td>{{ $o->estadia }}</td>
                    <td>{{ $o->viajantes }}</td>
                    <td>{{ $o->valorTotal }}</td>
                    <td>{{ $o->cliente->nome }}</td>
                    <td>
                        @if(Auth::user()->role === 'ADM')
                        <a href="/orcamentos/{{ $o->id }}/edit" class="btn btn-warning">Editar</a>
                        @endif
                        <a href="/orcamentos/{{ $o->id }}" class="btn btn-info">Consultar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection