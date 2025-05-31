@extends('layout')

@section('principal')

    <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary mb-4"><i class="bi bi-arrow-left"></i> Voltar</a>
     <h2><i class="bi bi-plus-circle"></i> Novo Cliente</h2>
     
     <form method="post" action="/clientes">
         @csrf
                         
         <div class="mb-3">
             <label for="nome" class="form-label">Nome:</label>
             <input type="text" id="nome" name="nome" class="form-control" required="">
         </div>

         <div class="mb-3">
             <label for="cpf" class="form-label">CPF:</label>
             <input type="text" id="cpf" name="cpf" class="form-control" required="">
         </div>
         
         <div class="mb-3">
             <label for="telefone" class="form-label">Telefone:</label>
             <input type="text" id="telefone" name="telefone" class="form-control" required="">
         </div>

         <div class="mb-3">
             <label for="endereco" class="form-label">Endereço:</label>
             <input type="text" id="endereco" name="endereco" class="form-control" required="">
         </div>
 
         <div class="mb-3">
             <label for="user_id" class="form-label">Usuário: </label>
             <select id="user_id" name="user_id" class="form-select" required="">
                 @foreach ($users as $u)
                     <option value="{{ $u->id }}">
                         {{ $u->email }}
                     </option>
                 @endforeach
             </select>
         </div>
 
         <button type="submit" class="btn btn-primary mb-3">
            <i class="bi bi-send-check"></i> Enviar
        </button>
     </form>
             
@endsection