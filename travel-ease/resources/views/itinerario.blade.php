@extends('layout')

@section('principal')
    <div class="container mt-4">
        <h2 class="mb-3"><i class="bi bi-airplane-engines"></i> Itinerário da Viagem</h2>

        <div class="mb-4">
            <h4>Informações da Viagem</h4>
            <p><strong>Origem:</strong> {{ $viagem->orcamento->origem }}</p>
            <p><strong>Destino:</strong> {{ $viagem->orcamento->destino }}</p>
            <p><strong>Cliente:</strong> {{ $viagem->orcamento->cliente->nome }}</p>
        </div>

       <div class="mb-4">
            <h4>Passagem</h4>
            <p><strong>Check-in:</strong> {{ $viagem->passagem->checkin }}</p>
            <p><strong>Check-out:</strong> {{ $viagem->passagem->checkout }}</p>
            <p><strong>Embarque:</strong> {{ $viagem->passagem->aeroOrigem }}</p>
            <p><strong>Desembarque:</strong> {{ $viagem->passagem->aeroDestino }}</p>
        </div>

        @if ($viagem->pacote)
            <h4>Pacote</h4>
            <p><strong>Passeios:</strong> {{ $viagem->pacote->passeios }}</p>
            <p><strong>Restaurantes:</strong> {{ $viagem->pacote->restaurantes }}</p>
        @endif

        <a href="{{ route('cliente.home') }}" class="btn btn-outline-secondary mb-4"><i class="bi bi-arrow-left"></i> Voltar</a>
    </div>
@endsection
