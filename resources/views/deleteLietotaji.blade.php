<!DOCTYPE html>
<html lang="lv">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dzēst lietotāju</title>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
</head>
<body>
    <!--Navigācija-->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/">Lietotāji</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="/addTerpi">tērpi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/addGrupas">grupas</a>
            </li>
          </ul>
        </div>
      </nav>


      <nav class="navbar navbar-expand-lg navbar-light navbar-lighter">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/">pievienot lietotāju</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="color:#3a88fe;" href="/viewLietotaji">lietotāju saraksts</a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container">
        <div class="row pt-5">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h4 class="card-header">Izdzēst šo lietotāju?</h4>
                    <div class="card-body">
                        <a href="{{ url('/viewLietotaji')}}" class="btn btn-sm btn-primary">Nē</a>
                        <a href="{{ url('deleteLietotajiData'.$personasKods)}}" class="btn btn-sm btn-danger">Jā</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
      </div>





  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu">