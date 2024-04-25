<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tērpi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            height: 100px; 
        }
    </style>
</head>
<body>
    <h2>Pieejamie tērpi</h2>
    <table>
        <thead>
            <tr>
                <th>Nosaukums</th>
                <th>Krasa</th>
                <th>Izmers</th>
                <th>Attēls</th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($TerpiData as $terps)
                <tr>
                    <td>{{ $terps->Nosaukums }}</td>
                    <td>{{ $terps->Krasa }}</td>
                    <td>{{ $terps->Izmers }}</td>
                    <td>
                        @if($terps->Attels)
                            <img src="data:image/jpeg;base64,{{ $terps->Attels }}" alt="Costume Image">
                        @else
                            Attēls nav pieejams
                        @endif
                    </td>
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
