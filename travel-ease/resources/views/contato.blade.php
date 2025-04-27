@extends('layout')

@section('principal')
    <div class="container mt-5">
        <h1 class="text-center mb-5">Contato</h1>

        <div class="row">
            <div class="col-md-6">
                <h3>Redes Sociais</h3>
                <ul class="list-unstyled">
                    <li>
                        <a href="https://www.instagram.com/travel_ease" target="_blank" class="text-decoration-none">
                            <i class="bi bi-instagram"></i> Instagram
                        </a>
                    </li>
                    <li>
                        <a href="https://x.com/travel_ease" target="_blank" class="text-decoration-none">
                            <i class="bi bi-twitter"></i> Twitter (X)
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-6">
                <h3>Informações de Contato</h3>
                <ul class="list-unstyled">
                    <li>
                        <strong>Email:</strong> <a href="mailto:contato@travelease.com" class="text-decoration-none">contato@travelease.com</a>
                    </li>
                    <li>
                        <strong>Telefone:</strong> (11) 1234-5678
                    </li>
                    <li>
                        <strong>WhatsApp:</strong> <a href="https://wa.me/551112345678" target="_blank" class="text-decoration-none">Clique aqui para falar no WhatsApp</a>
                    </li>
                    <li>
                        <strong>Endereço:</strong> Rua Vitor Bonfim, 123, São Paulo, SP
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
