@extends('layout')

@section('principal')
    <div class="mb-4">
        <h2><i class="bi bi-envelope-paper"></i> Enviar Aviso ao Cliente</h2>
        <p>Cliente: <strong>{{ $passagem->viagem->orcamento->cliente->nome }}</strong></p>
        <p>Destino: <strong>{{ $passagem->viagem->orcamento->destino }}</strong></p>
        <p>Check-in: <strong>{{ \Carbon\Carbon::parse($passagem->checkin)->format('d/m/Y') }}</strong></p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('passagens.avisos.enviar', $passagem->id) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf
        <div class="mb-3">
            <label for="arquivo" class="form-label">Anexar Passagem (PDF)</label>
            <input type="file" class="form-control" id="arquivo" name="arquivo" accept=".pdf" required>
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ route('passagens.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-send"></i> Enviar Aviso
            </button>
        </div>
    </form>
@endsection
