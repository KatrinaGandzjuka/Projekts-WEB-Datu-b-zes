<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audzēkņa Drukāšanas Informācija</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @media print {
            .no-print { display: none; }
        }
        body { padding: 20px; }
    </style>
</head>
<body onload="window.print();">
    <div class="container">
        <h2>Audzēkņa Informācija</h2>
        <p><strong>Grupas:</strong></p>
        <ul>
            @foreach($GrupasData as $grupa)
                <li>{{ $grupa->GrupasNosaukums }} - {{ $grupa->Grafiks }} - {{ $grupa->Filiale }}</li>
            @endforeach
        </ul>

        <p><strong>Pedagogi:</strong></p>
        <ul>
            @foreach($PedagogsData as $pd)
                <li>{{ $pd->Vards }} {{ $pd->Uzvards }} - {{ $pd->Talrunis }} - {{ $pd->Epasts }}</li>
            @endforeach
        </ul>

        <p><strong>Vecāki:</strong></p>
        <ul>
            @foreach($VecaksData as $vd)
                <li>{{ $vd->Vards }} {{ $vd->Uzvards }} - {{ $vd->Talrunis }} - {{ $vd->Epasts }}</li>
            @endforeach
        </ul>

        <p><strong>Kostīmi:</strong></p>
        <ul>
            @foreach($TerpiData as $td)
                <li>{{ $td->Nosaukums }} - Izmērs: {{ $td->Izmers }} - Krāsa: {{ $td->Krasa }} - Izsniegšanas datums: {{ $td->PiesDatums }}</li>
            @endforeach
        </ul>
    </div>
    <script>
        window.addEventListener('load', function() {
            window.print();
        });
    </script>
</body>
</html>
