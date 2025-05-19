<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Aviso de Viagem</title>
</head>
<body>
    <p>Olá {{ $nome ?? 'Cliente' }},</p>

    <p>
    Estamos passando para lembrar que sua viagem com destino a
    <strong>{{ $destino ?? 'destino desconhecido' }}</strong>
    está marcada para o dia
    <strong>{{ $checkin ? \Carbon\Carbon::parse($checkin)->format('d/m/Y') : 'data indefinida' }}</strong>.
    </p>

    <p>Em anexo, você encontra sua passagem.</p>

    <p>Boa viagem!</p>

    <p>Atenciosamente,<br>TravelEase</p>

</body>
</html>
