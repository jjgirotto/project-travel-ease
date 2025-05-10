<footer class="bg-dark text-white mt-auto py-3 w-100">
    <div class="container-fluid d-flex justify-content-between align-items-center px-4">
        <span>&copy; {{ date('Y') }} TravelEase. Todos os direitos reservados.</span>
        <div>
        @if(Auth::user()->role === 'CLI')
            <a href="/sobre" class="text-decoration-none text-info me-3">Sobre</a>
            <a href="/contato" class="text-decoration-none text-info">Contato</a>
        @endif
        </div>
    </div>
</footer>
