@extends('layout')

@section('principal')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-person-circle"></i> Clientes</h2>
        <a class="btn btn-success" href="{{ route('clientes.create') }}">
            <i class="bi bi-plus-lg"></i> Novo Cliente
        </a>
    </div>

    @if (session('erro'))
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <div>{{ session('erro') }}</div>
        </div>
    @endif

    @if (session('sucesso'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <div>{{ session('sucesso') }}</div>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nome do Cliente</th>
                    <th>Email</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->nome }}</td>
                        <td>{{ $c->user->email }}</td>
                        <td>{{ $c->endereco }}</td>
                        <td>{{ $c->telefone }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="/clientes/{{ $c->id }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye me-1"></i> Consultar
                                </a>
                                <a href="/clientes/{{ $c->id }}/edit" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil me-1"></i> Editar
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
