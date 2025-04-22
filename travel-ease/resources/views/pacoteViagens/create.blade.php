@extends('layout')

@section('principal')
    <h1>Novo Pacote de Viagem</h1>

    <form action="/pacoteViagens" method="post">
        @csrf
        <div class="mt-3">
            <label for="passeios" class="form-label">Passeios:</label>
            <input type="text" name="passeios" id="passeios" class="form-control">
        </div>

        <div class="mt-3">
            <label for="restaurantes" class="form-label">Restaurantes</label>
            <input type="text" name="restaurantes" id="restaurantes" class="form-control">
        </div>

        <div class="mt-3 mb-3">
             <label for="viagem_id" class="form-label">Viagem: </label>
             <select id="viagem_id" name="viagem_id" class="form-select" required="">
                 @foreach ($viagens as $v)
                     <option value="{{ $v->id }}">
                         {{ $v->orcamento->origem }} x {{ $v->orcamento->destino }}: {{ $v->orcamento->cliente->nome }} - CPF: {{ $v->orcamento->cliente->cpf }}
                     </option>
                 @endforeach
             </select>
        </div>
 
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

@endsection