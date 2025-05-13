@extends('layout')

@section('principal')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-briefcase-fill"></i> Viagens</h2>

        @if(auth()->user()->role === 'ADM')
        <a class="btn btn-success" href="/viagens/create">
            <i class="bi bi-plus-lg"></i> Nova Viagem
        </a>
        @endif
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
                            <div class="d-flex justify-content-center gap-2">
                                @if(auth()->user()->role === 'ADM')
                                <a href="/viagens/{{ $v->id }}/edit" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil me-1"></i> Editar
                                </a>
                                @endif
                                <a href="/viagens/{{ $v->id }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye me-1"></i> Consultar
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
