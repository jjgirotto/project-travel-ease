@extends('layout')

@section('principal')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-airplane-engines"></i> Passagens Emitidas</h2>

        @if(Auth::user()->role === 'ADM')
        <a class="btn btn-success" href="/passagens/create">
            <i class="bi bi-plus-lg"></i> Nova Passagem
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
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Embarque</th>
                    <th>Desembarque</th>
                    <th>Viagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($passagens as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->checkin }}</td>
                        <td>{{ $p->checkout }}</td>
                        <td>{{ $p->aeroOrigem }}</td>
                        <td>{{ $p->aeroDestino }}</td>
                        <td>{{ $p->viagem->orcamento->origem }} x {{ $p->viagem->orcamento->destino }}: {{ $p->viagem->orcamento->cliente->nome }} - CPF: {{ $p->viagem->orcamento->cliente->cpf }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                @if(Auth::user()->role === 'ADM')
                                <a href="/passagens/{{ $p->id }}/edit" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil me-1"></i> Editar
                                </a>
                                <a href="{{ route('passagens.avisos.form', $p->id) }}" class="btn btn-sm btn-secondary">
                                    <i class="bi bi-envelope-paper"></i> Avisos
                                </a>
                                @endif
                                <a href="/passagens/{{ $p->id }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye me-1"></i> Consultar
                                </a>
                                @if(auth()->user()->role === 'CLI')
                                <a href="{{ route('emitir.itinerario', $p->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-file-earmark-text me-1"></i> Emitir Itinerário
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
