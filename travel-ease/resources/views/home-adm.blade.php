@extends('layout')
@section('principal')
  <h2>Bem vindo {{Auth::user()->name}}! </h2>
  <div class="container mt-4">

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Viagens Agendadas</h5>
                    <p class="card-text fs-4">{{ $viagensAgendadas }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Orçamentos no Mês</h5>
                    <p class="card-text fs-4">{{ $orcamentosMes }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Destinos Ativos</h5>
                    <p class="card-text fs-4">{{ $destinosAtivos }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Clientes Atendidos</h5>
                    <p class="card-text fs-4">{{ $clientesMes }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico e Mapa -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Destinos Mais Frequentes</div>
                <div class="card-body">
                    <canvas id="graficoDestinos" style="height: 300px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Mapa das Viagens</div>
                <div class="card-body">
                    <div id="mapa" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Viagens em Breve -->
    <div class="card mb-4">
        <div class="card-header">Próximas Viagens</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Destino</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($viagensProximas as $v)
                        <tr>
                        <td>{{ $v->viagem->orcamento->cliente->nome ?? '-' }}</td>
                        <td>{{ $v->viagem->orcamento->destino ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($v->checkin)->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Orçamentos Recentes -->
    <div class="card mb-4">
        <div class="card-header">Orçamentos Recentes</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Destino</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orcamentos as $o)
                        <tr>
                            <td>{{ $o->cliente->nome }}</td>
                            <td>{{ $o->destino }}</td>
                            <td>{{ \Carbon\Carbon::parse($o->created_at)->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Últimos Clientes -->
    <div class="card mb-4">
        <div class="card-header">Últimos Clientes</div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($clientesRecentes as $cliente)
                    <li class="list-group-item">
                        {{ $cliente->nome }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('graficoDestinos').getContext('2d');
    const destinosChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($destinosFrequentes->pluck('destino_normalizado')) !!},
            datasets: [{
                label: 'Número de Viagens',
                data: {!! json_encode($destinosFrequentes->pluck('total')) !!},
                backgroundColor: 'rgba(13, 110, 253, 0.7)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>

<!-- Leaflet Mapa -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    const mapa = L.map('mapa').setView([-15.77972, -47.92972], 4);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapa);

    @foreach($viagensProximas as $v)
    L.marker([{{ $v->latitude }}, {{ $v->longitude }}])
        .addTo(mapa)
        .bindPopup('<strong>{{ addslashes($v->destino) }}</strong><br>{{ addslashes($v->viagem->orcamento->cliente->nome ?? '-') }}');
    @endforeach
</script>
@endsection