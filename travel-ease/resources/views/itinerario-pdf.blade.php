<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Itinerário da Viagem</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 40px;
        }

        h2 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        h4 {
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .section {
            margin-bottom: 20px;
        }

        .label {
            font-weight: bold;
        }

        .back-link {
            margin-top: 30px;
            display: inline-block;
            font-size: 12px;
            color: #555;
            text-decoration: none;
        }

        .back-link::before {
            content: "← ";
        }
    </style>
</head>
<body>
    <h2>Itinerário da Viagem</h2>

    <div class="section">
        <h4>Informações da Viagem</h4>
        <p><span class="label">Origem:</span> {{ $viagem->orcamento->origem }}</p>
        <p><span class="label">Destino:</span> {{ $viagem->orcamento->destino }}</p>
        <p><span class="label">Cliente:</span> {{ $viagem->orcamento->cliente->nome }}</p>
    </div>

    <div class="section">
        <h4>Passagem</h4>
        <p><span class="label">Check-in:</span> {{ $viagem->passagem->checkin }}</p>
        <p><span class="label">Check-out:</span> {{ $viagem->passagem->checkout }}</p>
        <p><span class="label">Embarque:</span> {{ $viagem->passagem->aeroOrigem }}</p>
        <p><span class="label">Desembarque:</span> {{ $viagem->passagem->aeroDestino }}</p>
    </div>

    @if ($viagem->pacote)
        <div class="section">
            <h4>Pacote</h4>
            <p><span class="label">Passeios:</span> {{ $viagem->pacote->passeios }}</p>
            <p><span class="label">Restaurantes:</span> {{ $viagem->pacote->restaurantes }}</p>
        </div>
    @endif
</body>
</html>
