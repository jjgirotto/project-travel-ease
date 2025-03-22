<!doctype html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Novo Orçamento</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   </head>
   <body class="container">
 
     <h1>Novo Orçamento</h1>
     
     <form method="post" action="/orcamentos">
         @csrf
                         
         <div class="mb-3">
             <label for="origem" class="form-label">Origem:</label>
             <input type="text" id="origem" name="origem" class="form-control" required="">
         </div>

         <div class="mb-3">
             <label for="destino" class="form-label">Destino:</label>
             <input type="text" id="destino" name="destino" class="form-control" required="">
         </div>

         <div class="mb-3">
             <label for="estadia" class="form-label">Quantidade de dias de estadia:</label>
             <input type="number" id="estadia" name="estadia" class="form-control" required="">
         </div>

         <div class="mb-3">
             <label for="viajantes" class="form-label">Quantidade de viajantes:</label>
             <input type="number" id="viajantes" name="viajantes" class="form-control" required="">
         </div>

        <div class="mb-3">
            <label for="acomodacao" class="form-label">Precisa de acomodação?</label>
            <input type="checkbox" id="acomodacao" name="acomodacao" class="form-check-input">
        </div>
         
         <div class="mb-3">
             <label for="preferencia" class="form-label">Preferência:</label>
             <input type="text" id="preferencia" name="preferencia" class="form-control">
         </div>

         <div class="mb-3">
             <label for="qtdeMilhas" class="form-label">Quantidade de milhas:</label>
             <input type="number" id="qtdeMilhas" name="qtdeMilhas" class="form-control">
         </div>

         <div class="mb-3">
             <label for="valorMilhas" class="form-label">Valor de milhas:</label>
             <input type="number" id="valorMilhas" name="valorMilhas" step="0.01" class="form-control">
         </div>

         <div class="mb-3">
             <label for="valorTotal" class="form-label">Valor total:</label>
             <input type="number" id="valorTotal" name="valorTotal" step="0.01" class="form-control">
         </div>

        <div class="mb-3">
            <label for="acomodacao" class="form-label">Orçamento escolhido:</label>
            <input type="checkbox" id="acomodacao" name="acomodacao" class="form-check-input">
        </div>
 
         <div class="mb-3">
             <label for="cliente_id" class="form-label">Cliente: </label>
             <select id="cliente_id" name="cliente_id" class="form-select" required="">
                 @foreach ($clientes as $c)
                     <option value="{{ $c->id }}">
                         {{ $c->nome }} - CPF: {{ $c->cpf }} 
                     </option>
                 @endforeach
             </select>
         </div>
 
         <button type="submit" class="btn btn-primary">Enviar</button>
     </form>
             
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   </body>
 </html>