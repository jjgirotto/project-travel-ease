@extends('layout')

@section('principal')
<div class="container mt-4">
    <h2>Bem vindo {{Auth::user()->cliente->nome ?? 'Visitante' }} ! </h2>

    <h3 class="mb-4 mt-4"><i class="bi bi-card-list"></i> Orçamentos em Aberto</h3>

    @if($orcamentosAbertos->isEmpty())
        <p class="text-muted">Você não possui orçamentos em aberto.</p>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Origem</th>
                        <th>Destino</th>
                        <th>Estadia</th>
                        <th>Viajantes</th>
                        <th>Valor Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orcamentosAbertos as $orc)
                        <tr>
                            <td>{{ $orc->origem }}</td>
                            <td>{{ $orc->destino }}</td>
                            <td>{{ $orc->estadia }}</td>
                            <td>{{ $orc->viajantes }}</td>
                            <td>
                                @if($orc->valorTotal == 0)
                                    A definir
                                @else
                                    R$ {{ number_format($orc->valorTotal, 2, ',', '.') }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <h3 class="my-4"><i class="bi bi-airplane-engines"></i> Viagens Próximas</h3>

    @if($viagensProximas->isEmpty())
        <p class="text-muted">Nenhuma viagem próxima com passagem emitida.</p>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Origem</th>
                        <th>Destino</th>
                        <th>Data Check-in</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($viagensProximas as $viagem)
                        <tr>
                            <td>{{ $viagem->orcamento->origem }}</td>
                            <td>{{ $viagem->orcamento->destino }}</td>
                            <td>{{ \Carbon\Carbon::parse($viagem->passagem->checkin)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('emitir.itinerario', ['viagem' => $viagem->id]) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-file-earmark-text me-1"></i> Emitir Itinerário
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection