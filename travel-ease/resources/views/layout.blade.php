<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Gerenciamento de Viagens</title>
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar estilo dark -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ Auth::check() ? (Auth::user()->role === 'ADM' ? '/home-adm' : '/home-cli') : '/' }}">
        TravelEase
        </a>

        <!-- Botão toggle para mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarConteudo" aria-controls="navbarConteudo" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Itens da navbar -->
        <div class="collapse navbar-collapse" id="navbarConteudo">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            @auth
            @if(Auth::user()->role === 'ADM')
                <li class="nav-item"><a class="nav-link" href="/clientes">Clientes</a></li>
                <li class="nav-item"><a class="nav-link" href="/orcamentos">Orçamentos</a></li>
                <li class="nav-item"><a class="nav-link" href="/viagens">Viagens</a></li>
                <li class="nav-item"><a class="nav-link" href="/pacoteViagens">Pacotes</a></li>
                <li class="nav-item"><a class="nav-link" href="/passagens">Passagens</a></li>
            @elseif(Auth::user()->role === 'CLI')
              <li class="nav-item"><a class="nav-link" href="/clientes">Perfil</a></li>
              <li class="nav-item"><a class="nav-link" href="/orcamentos">Orçamentos</a></li>
              <li class="nav-item"><a class="nav-link" href="/viagens">Viagens</a></li>
              <li class="nav-item"><a class="nav-link" href="/pacoteViagens">Pacotes</a></li>
              <li class="nav-item"><a class="nav-link" href="/passagens">Passagens</a></li>   
              <li class="nav-item"><a class="nav-link" href="/sobre">Sobre</a></li>
              <li class="nav-item"><a class="nav-link" href="/contato">Contato</a></li>
            @endif
            @endauth

        </ul>

        @auth
            <form method="POST" action="/logout" class="d-flex" role="logout">
            @csrf
            <button type="submit" class="btn btn-danger">Sair</button>
            </form>
        @endauth

        </div>
    </div>
    </nav>

  <main class="container mt-4">
    @yield('principal')
  </main>
  
  <!-- Bootstrap JS Bundle (com Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>