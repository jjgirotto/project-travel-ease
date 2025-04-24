@extends('layout')

@section('principal')
 
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
        @if(Auth::user()->role === 'ADM')
        <button type="submit" class="btn btn-danger">Excluir</button>
        <a href="/clientes" class="btn btn-primary">Cancelar</a>
        @endif
    </form>
            
@endsection