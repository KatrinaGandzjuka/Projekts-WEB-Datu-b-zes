<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numura pievienošana</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
</head>
<body>
<!--Navigation-->
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

<!--Form-->
<div class="container">
    <h2>Pievienot Jaunu Numuru</h2>
    <form action="{{ route('numurs.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nosaukums">Nosaukums:</label>
            <input type="text" class="form-control" name="nosaukums" placeholder="Ievadiet numura nosaukumu" required autofocus>
        </div>
        <div class="form-group">
            <label for="garums">Garums (sekundēs):</label>
            <input type="number" class="form-control" name="garums" placeholder="Ievadiet numura garumu" required>
        </div>
        <div class="form-group">
            <label for="muzikas_nosaukums">Mūzikas Nosaukums:</label>
            <input type="text" class="form-control" name="muzikas_nosaukums" placeholder="Ievadiet mūzikas nosaukumu" required>
        </div>
        <div class="form-group">
            <label for="pedagogs">Pedagogi:</label>
            <select multiple class="form-control" name="pedagogs[]" required>
                @foreach ($pedagogs as $ped)
                    <option value="{{ $ped->personasKods }}">{{ $ped->Vards }} {{ $ped->Uzvards }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="audzeknis">Audzēkņi:</label>
            <select multiple class="form-control" name="audzeknis[]" required>
                @foreach ($audzeknis as $student)
                    <option value="{{ $student->id }}">{{ $student->Vards }} {{ $student->Uzvards }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="kostims">Kostīmi:</label>
            <select multiple class="form-control" name="kostims[]" required>
                @foreach ($kostims as $costume)
                    <option value="{{ $costume->id }}">{{ $costume->Nosaukums }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Pievienot numuru</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
