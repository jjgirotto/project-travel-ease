@extends('layout')

@section('principal')
    <a href="{{ route('pacoteViagens.index') }}" class="btn btn-outline-secondary mb-4"><i class="bi bi-arrow-left"></i> Voltar</a>
    <h2><i class="bi bi-pencil-square"></i> Editar Pacote de Viagem</h2>

    <form method="post" action="/pacoteViagens/{{ $pacote-> id }}">
      @csrf
      @method('PUT')

      <div class="mt-3">
          <label for="passeios" class="form-label">Passeios:</label>
          <input type="text" name="passeios" id="passeios" value = "{{ $pacote->passeios }}" class="form-control">
      </div>

      <div class="mt-3">
          <label for="restaurantes" class="form-label">Restaurantes</label>
          <input type="text" name="restaurantes" id="restaurantes" value = "{{ $pacote->restaurantes }}" class="form-control">
      </div>

      <div class="mt-3 mb-3">
            <label for="viagem_id" class="form-label">Viagem: </label>
            <select id="viagem_id" name="viagem_id" class="form-select" required="">
                @foreach ($viagens as $v)
                    <option value="{{ $v->id }}" {{ $pacote->viagem_id == $v->id ? "selected" : ""}} >
                      {{ $v->orcamento->origem }} x {{ $v->orcamento->destino }}: {{ $v->orcamento->cliente->nome }} - CPF: {{ $v->orcamento->cliente->cpf }}
                    </option>
                @endforeach
            </select>
      </div>

    <button type="submit" class="btn btn-primary mb-3">
        <i class="bi bi-send-check"></i> Enviar
    </button>
  </form>

@endsection