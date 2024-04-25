<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numuru saraksts</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="{{ route('numurs.index') }}">Numuri</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('numurs.create') }}">Pievienot numuru</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('numurs.index') }}">Numuru saraksts</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <h2>Numuru Saraksts</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nosaukums</th>
                <th>Garums</th>
                <th>Mūzikas Nosaukums</th>
                <th>Pedagogi</th>
                <th>Audzēkņi</th>
                <th>Kostīmi</th>
                <th>Rediģēšana</th>
                <th>Dzēšana</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($numurs as $numur)
            <tr>
                <td>{{ $numur->nosaukums }}</td>
                <td>{{ $numur->garums }}</td>
                <td>{{ $numur->muzikas_nosaukums }}</td>
                <td>
                    @foreach ($numur->pedagogs as $pedagogs)
                        {{ $pedagogs->Vards }} {{ $pedagogs->Uzvards }}<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($numur->audzeknis as $audzeknis)
                        {{ $audzeknis->Vards }} {{ $audzeknis->Uzvards }}<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($numur->kostims as $kostims)
                        {{ $kostims->Nosaukums }}<br>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('numurs.edit', $numur->id) }}" class="btn btn-primary">Rediģēt</a>
                </td>
                <td>
                    <form action="{{ route('numurs.destroy', $numur->id) }}" method="POST" onsubmit="return confirm('Vai tiešām vēlaties dzēst šo numuru?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Dzēst</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
