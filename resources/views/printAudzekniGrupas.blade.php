<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupa: {{ $GrupasData->GrupasNosaukums }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Grupa: {{ $GrupasData->GrupasNosaukums }}</h2>
    <h3>Pedagogi: 
        @foreach($PedagogsData as $pedagogs)
            {{ $loop->first ? '' : ', ' }}{{ $pedagogs->Vards }} {{ $pedagogs->Uzvards }}
        @endforeach
    </h3>
    <h4>{{ $GrupasData->Grafiks }}</h4>
    <table>
        <thead>
            <tr>
                <th>Vārds, Uzvārds</th>
                <th>Personas Kods</th>
                <th>Tālruņa numurs</th>
            </tr>
        </thead>
        <tbody>
            @foreach($LietotajsData as $ld)
            <tr>
                <td>{{ $ld->Vards }} {{ $ld->Uzvards }}</td>
                <td>{{ $ld->personasKods }}</td>
                <td>{{ $ld->Talrunis }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        window.addEventListener('load', function() {
            window.print();
        });
    </script>
</body>
</html>
