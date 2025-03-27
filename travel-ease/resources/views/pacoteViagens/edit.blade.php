<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar pacote de viagem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="container">
    <h1>Editar Pacote de Viagem</h1>

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
            <label for="orcamento_id" class="form-label">Orçamento: </label>
            <select id="orcamento_id" name="orcamento_id" class="form-select" required="">
                @foreach ($orcamentos as $o)
                    <option value="{{ $o->id }}" {{ $pacote->orcamento_id == $o->id ? "selected" : ""}} >
                        {{ $o->origem }} x {{ $o->destino }}: {{ $o->cliente->nome }} - CPF: {{ $o->cliente->cpf }}
                    </option>
                @endforeach
            </select>
      </div>

      <button type="submit" class="btn btn-primary">Enviar</button>
  </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>