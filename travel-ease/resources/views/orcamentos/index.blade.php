@extends('layout')

@section('principal')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-cash-coin"></i> Orçamentos</h2>
        <a class="btn btn-success" href="/orcamentos/create">
            <i class="bi bi-plus-lg"></i> Novo Orçamento
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
                        <td>
                            @if($o->valorTotal == 0)
                                A definir
                            @else
                                R$ {{ number_format($o->valorTotal, 2, ',', '.') }}
                            @endif
                        </td>
                        <td>{{ $o->cliente->nome }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="/orcamentos/{{ $o->id }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye me-1"></i> Consultar
                                </a>
                                @if(Auth::user()->role === 'ADM')
                                    <a href="/orcamentos/{{ $o->id }}/edit" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil me-1"></i> Editar
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
