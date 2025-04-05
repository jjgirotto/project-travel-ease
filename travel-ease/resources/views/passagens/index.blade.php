<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Passagens Emitidas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="container">
    <h1>Passagens Emitidas</h1>

    <a class="btn btn-primary" href="/passagens/create">Nova Passagem</a>

    @if (session('erro'))
        <div class="alert alert-danger">
            {{ session('erro') }}
        </div>
    @endif
    @if (session('sucesso'))
        <div class="alert alert-success">
            {{ session('sucesso') }}
        </div>
    @endif

    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Embarque</th>
                <th>Desembarque</th>
                <th>Viagem</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($passagem as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->checkin }}</td>
                    <td>{{ $p->checkout }}</td>
                    <td>{{ $p->aeroOrigem }}</td>
                    <td>{{ $p->aeroDestino }}</td>
                    <td>{{ $p->viagem->orcamento->origem }} x {{ $p->viagem->orcamento->destino }}: {{ $p->viagem->orcamento->cliente->nome }} - CPF: {{ $p->viagem->orcamento->cliente->cpf }}</td>
                    <td>
                        <a href="/passagens/{{ $p->id }}/edit" class="btn btn-warning">Editar</a>
                        <a href="/passagens/{{ $p->id }}" class="btn btn-info">Consultar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>