<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultar Passagem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="container">
    <h1>Consultar Passagem</h1>

    <form action="/passagens/{{ $passagem->id }}" method="post">
    @csrf  
    @method('DELETE')
    <div class="row mt-3">
        <div class="col-3">
            <label for="checkin" class="form-label">Data de Check-in:</label>
            <input type="date" name="checkin" id="checkin" value="{{ $passagem->checkin }}" class="form-control" disabled>
        </div>
        <div class="col-3">
            <label for="checkout" class="form-label">Data de Check-out:</label>
            <input type="date" name="checkout" id="checkout" value="{{ $passagem->checkout }}" class="form-control" disabled>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-5">
            <label for="aeroOrigem" class="form-label">Local de Embarque:</label>
            <input type="text" name="aeroOrigem" id="aeroOrigem" value="{{ $passagem->aeroOrigem }}" class="form-control" disabled>
        </div>
        <div class="col-5">
            <label for="aeroDestino" class="form-label">Local de Desembarque:</label>
            <input type="text" name="aeroDestino" id="aeroDestino" value="{{ $passagem->aeroDestino }}" class="form-control" disabled>
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <label for="viagem_id" class="form-label">Viagem: </label>
        <select name="viagem_id" id="viagem_id" class="form-select" disabled>
            @foreach($viagens as $v)
                <option value="{{ $v->id }}" {{ $passagem->viagem_id == $v->id ? "selected" : "" }}>
                    {{ $v->orcamento->origem }} x {{ $v->orcamento->destino }}: {{ $v->orcamento->cliente->nome }} - CPF: {{ $v->orcamento->cliente->cpf }}
                </option>
            @endforeach
        </select>
    </div>

    <p>Deseja excluir o registro?</p>
    <button type="submit" class="btn btn-danger">Excluir</button>
    <a href="/passagens" class="btn btn-primary">Cancelar</a>

    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>