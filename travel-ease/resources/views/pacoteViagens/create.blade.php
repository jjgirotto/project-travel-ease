<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Novo pacote de viagem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="container">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>