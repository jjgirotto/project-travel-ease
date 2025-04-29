@extends('layout')

@section('principal')
    <div class="container mt-5">
        <h1 class="text-center mb-5">Sobre Nós</h1>

        <div class="row">
            <!-- Foto da Equipe -->
            <div class="col-md-6">
                <img src="{{ asset('storage/equipe.jpg') }}" class="img-fluid rounded shadow-lg" alt="Foto da Equipe">
            </div>

            <!-- Informações da Empresa -->
            <div class="col-md-6">
                <h2>Quem Somos?</h2>
                <p>A nossa equipe é formada por profissionais apaixonados por viagens e comprometidos em proporcionar experiências únicas aos nossos clientes. Com uma longa trajetória no mercado, buscamos sempre superar as expectativas, oferecendo pacotes personalizados e atendimento de excelência.</p>
                <h3>Nossa Missão</h3>
                <p>Proporcionar aos nossos clientes momentos inesquecíveis, com viagens inesquecíveis, sempre com o máximo conforto e segurança.</p>
                <h3>Valores</h3>
                <ul>
                    <li>Comprometimento com o cliente</li>
                    <li>Excelência no atendimento</li>
                    <li>Inovação constante</li>
                    <li>Responsabilidade ambiental e social</li>
                </ul>
            </div>
        </div>

        <hr class="my-5">

        <!-- Seção de Equipe -->
        <h2 class="text-center mb-4">Nossa Equipe</h2>
        <div class="row">
            <div class="col-md-4 text-center">
                <h4>João Silva</h4>
                <p>Fundador e CEO</p>
                <p>João é o responsável pela visão e estratégia da nossa empresa, com mais de 15 anos de experiência no mercado de turismo.</p>
            </div>
            <div class="col-md-4 text-center">
                <h4>Maria Souza</h4>
                <p>Diretora de Vendas</p>
                <p>Maria lidera nossa equipe de vendas, trazendo soluções personalizadas para cada cliente, garantindo a melhor experiência de viagem.</p>
            </div>
            <div class="col-md-4 text-center">
                <h4>Lucas Pereira</h4>
                <p>Coordenador de Operações</p>
                <p>Lucas é o responsável por garantir que cada viagem aconteça conforme planejado, gerenciando todas as operações e logística.</p>
            </div>
        </div>
    </div>
@endsection

