<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Orçamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="container">

    <h1>Editar Orçamento</h1>
    
    <form method="post" action="/orcamentos/{{ $orcamento->id }}">
        @csrf
        @method('DELETE')

        <div class="mb-3">
            <label for="origem" class="form-label">Origem:</label>
            <input type="text" id="origem" name="origem" value = "{{ $orcamento->origem }}" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label for="destino" class="form-label">Destino:</label>
            <input type="text" id="destino" name="destino" value = "{{ $orcamento->destino }}" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label for="estadia" class="form-label">Quantidade de dias de estadia:</label>
            <input type="number" id="estadia" name="estadia" value = "{{ $orcamento->estadia}}" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label for="viajantes" class="form-label">Quantidade de viajantes:</label>
            <input type="number" id="viajantes" name="viajantes" value = "{{ $orcamento->viajantes }}" class="form-control" disabled>
        </div>

    <div class="mb-3">
        <label for="acomodacao" class="form-label">Precisa de acomodação?</label>
        <input type="checkbox" id="acomodacao" name="acomodacao" class="form-check-input" disabled value="1" {{ $orcamento->acomodacao ? 'checked' : '' }}>
    </div>
        
        <div class="mb-3">
            <label for="preferencia" class="form-label">Preferência:</label>
            <input type="text" id="preferencia" name="preferencia" value = "{{ $orcamento->preferencia }}" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label for="qtdeMilhas" class="form-label">Quantidade de milhas:</label>
            <input type="number" id="qtdeMilhas" name="qtdeMilhas" value = "{{ $orcamento->qtdeMilhas }}" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label for="valorMilhas" class="form-label">Valor de milhas:</label>
            <input type="number" id="valorMilhas" name="valorMilhas" step="0.01" value = "{{ $orcamento->valorMilhas }}" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label for="valorTotal" class="form-label">Valor total:</label>
            <input type="number" id="valorTotal" name="valorTotal" step="0.01" value = "{{ $orcamento->valorTotal }}" class="form-control" disabled>
        </div>

    <div class="mb-3">
        <label for="escolhido" class="form-label">Orçamento escolhido:</label>
        <input type="checkbox" id="escolhido" name="escolhido" class="form-check-input" value="1" {{ $orcamento->escolhido ? 'checked' : '' }} disabled>
    </div>

        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente: </label>
            <select id="cliente_id" name="cliente_id" class="form-select" disabled>
                @foreach ($clientes as $c)
                    <option value="{{ $c->id }}" {{ $orcamento->cliente_id == $c->id ? "selected" : ""}}>
                        {{ $c->nome }} - CPF: {{ $c->cpf }} 
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-danger">Excluir</button>
        <a href="/orcamentos" class="btn btn-primary">Cancelar</a>
    </form>
            
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>