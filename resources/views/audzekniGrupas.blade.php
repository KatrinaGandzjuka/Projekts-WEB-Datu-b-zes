<!DOCTYPE html>
<html lang="lv">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupu saraksts</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
  </head>
  <body>
    <!--Navigācija-->
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="/addGrupas">Grupas</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/addTerpi">tērpi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/">lietotāji</a>
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
            <a class="nav-link" href="/addGrupas">pievienot grupu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color:#3a88fe;" href="/viewGrupas">grupu saraksts</a>
          </li>
        </ul>
      </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light navbar-brighter">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <a class="navbar-brand" style="color:#3a88fe;" href="{{ '/audzekniGrupas'.$GrupasNosaukums }}">{{$GrupasNosaukums}}</a>
          <li class="nav-item">
            <a class="nav-link" href="{{ '/pievAudzAudzekniGrupas'.$GrupasNosaukums}}">pievienot audzēkni</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ '/pievPedPedagogiGrupas'.$GrupasNosaukums}}">pievienot pedagogu</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <a href="{{ route('print.audzekni.grupas', ['GrupasNosaukums' => $GrupasNosaukums]) }}" class="btn btn-primary mb-3" target="_blank">Izprintēt sarakstu</a>
      <table class="table">
        <thead>
          <tr>
            <th>Loma</th>
            <th>Personas Kods</th>
            <th>Vārds un uzvārds</th>
            <th>Dzimšanas diena</th>
            <th>Dzēšana</th>
          </tr>
        </thead>
        <tbody> @foreach($LietotajsData as $ld) <tr>
            <td> @foreach($LomasData as $lomd) @if($lomd->LomaID == $ld->LomaID) {{$lomd->LomasNosaukums}} @endif @endforeach </td>
            <td>{{$ld->personasKods}}</td>
            <td>{{$ld->Vards}} {{$ld->Uzvards}}</td>
            <td>{{$ld->DzimDiena}}</td>
            <td> @if($ld->LomaID == 1) <a class="btn btn-danger" href="/dataDeleteAudzekniGrupas{{$GrupasNosaukums}}/{{$ld->personasKods}}">Dzēst no grupas</a> @elseif($ld->LomaID == 3) <a class="btn btn-danger" href="/dataDeletePedagogiGrupas{{$GrupasNosaukums}}/{{$ld->personasKods}}">Dzēst no grupas</a> @endif </td>
          </tr> @endforeach </tbody>
      </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu">