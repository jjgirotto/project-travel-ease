<!doctype html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Consultar Viagem</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   </head>
   <body class="container">
 
     <h1>Consultar Viagem</h1>
     
     <form method="post" action="/viagens/{{ $viagem->id }}">
        @csrf
        @method('DELETE')                 
        <div class="mb-3">
            <label for="pagamento" class="form-label">Forma de Pagamento:</label>
            <select id="pagamento" name="pagamento" class="form-select" disabled>
                <option value="Débito" {{ $viagem->pagamento == "Débito" ? "selected" : "" }}>Débito</option>
                <option value="Pix" {{ $viagem->pagamento == "Pix" ? "selected" : "" }}>Pix</option>
                <option value="Crédito" {{ $viagem->pagamento == "Crédito" ? "selected" : "" }}>Crédito</option>
            </select>
        </div>
 
         <div class="mb-3">
             <label for="orcamento_id" class="form-label">Orçamento: </label>
             <select id="orcamento_id" name="orcamento_id" class="form-select" disabled>
                 @foreach ($orcamentos as $o)
                     <option value="{{ $o->id }}" {{ $viagem->orcamento_id == $o->id ? "selected" : "" }}>
                         {{ $o->origem }} x {{ $o->destino }}: {{ $o->cliente->nome }} - CPF: {{ $o->cliente->cpf }}
                     </option>
                 @endforeach
             </select>
         </div>
 
         <p>Deseja excluir o registro?</p>
         <button type="submit" class="btn btn-danger">Excluir</button>
         <a href="/viagens" class="btn btn-primary">Cancelar</a>
     </form>
             
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   </body>
 </html>