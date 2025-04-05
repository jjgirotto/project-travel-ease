<!doctype html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Consultar Cliente</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   </head>
   <body class="container">
 
    <h1>Consultar Cliente</h1>
    
    <form method="post" action="/clientes/{{ $cliente-> id }}">
        @csrf
        @method('DELETE')        
                        
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" id="nome" name="nome" value = "{{ $cliente->nome }}" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label for="cpf" class="form-label">CPF:</label>
            <input type="text" id="cpf" name="cpf" value = "{{ $cliente->cpf }}" class="form-control" disabled>
        </div>
        
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value = "{{ $cliente->telefone }}" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço:</label>
            <input type="text" id="endereco" name="endereco" value = "{{ $cliente->endereco }}" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">Usuário: </label>
            <select id="user_id" name="user_id" class="form-select" disabled>
                @foreach ($users as $u)
                    <option value="{{ $u->id }}" {{ $cliente->user_id == $u->id ? "selected" : ""}} >
                        {{ $u->email }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-danger">Excluir</button>
        <a href="/clientes" class="btn btn-primary">Cancelar</a>
    </form>
            
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   </body>
 </html>