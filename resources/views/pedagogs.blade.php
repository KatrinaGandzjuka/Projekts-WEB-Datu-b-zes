<!DOCTYPE html>
<html lang="lv">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title class="navbar-brand" href="/login">Audzeknis</title>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
</head>
<body>
@if(session('success'))
    @if(session('success') == true)
        <script>alert("Lietotaja dati tika pievienoti ;)");</script>
    @else
        <script>alert("Lietotaja dati netika pievienoti :(");</script>
    @endif
@endif


    <!--Navigācija-->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/login">Pedagogs </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </nav>

      <div class="container">

        <table class="table">
            <thead>
            <th colspan="4" style="font-size: larger">Grupas:</th>
                <tr>
                    <th>Nosaukums</th>
                    <th>Grafiks</th>
                    <th>Filiale</th>
                    <th>Adrese</th>
                </tr>
            </thead>
            <tbody>
                @foreach($GrupasData as $gd)
                <tr>
                    <td>{{$gd->GrupasNosaukums}}</td>
                    <td>{{$gd->Grafiks}}</td>
                    <td>{{$gd->Filiale}}</td>
                    <td>{{$gd->Valsts}}, {{$gd->Pilseta}}, {{$gd->Rajons}}, {{$gd->Iela}}, {{$gd->Eka}}, {{$gd->Indekss}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>


        <div class="container">
        <table class="table">
            <thead>
            <th colspan="6" style="font-size: larger">Audzēkņi:</th>
                <tr>
                    <th>Vārds un uzvārds</th>
                    <th>Personas Kods</th>
                    <th>Tālrunis</th>
                    <th>E-pasts</th>
                    <th>Dzimšanas diena</th>
                    <th>Vecums</th>
                </tr>
            </thead>
            <tbody>
            @foreach($AudzeknisData as $ad)
            <tr>
               <td>
                <a href="{{'/audzeknis'.$ad->personasKods}}">{{$ad->Vards}} {{$ad->Uzvards}}</a>
                </td>
                  <td>{{$ad->personasKods}}</td>
                    <td>{{$ad->Talrunis}}</td>
                    <td>{{$ad->Epasts}}</td>
                    <td>{{$ad->DzimDiena}}</td>
                    <td>{{ \Carbon\Carbon::parse($ad->DzimDiena)->age }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="container">
        <table class="table">
        @if (session('LomaID') == 3)
            <thead>
            <th colspan="8" style="font-size: larger">Pieejami tērpi</th>
                <tr>
                    <th>Nosaukums</th>
                    <th>Izmērs</th>
                    <th>Krāsa</th>
                    <th>Attēls</th>
                    <th>Izdalīšana</th>
                    <th>Savākšana</th>
                </tr>
            </thead>
            <tbody>
                @foreach($TerpiData as $td)
                <tr>
                    <td>{{$td->Nosaukums}}</td>
                    <td>{{$td->Izmers}}</td>
                    <td>{{$td->Krasa}}</td>
                    <td><img src="data:image/{{strtolower(pathinfo($td->Attels, PATHINFO_EXTENSION))}};base64,{{$td->Attels}}" /></td>
                    <td><a href="{{ url('/iedalitTerpi'.$td->KostimiID) }}" class="btn btn-primary">Izdalīt</a></td>
                    <td><a class="btn btn-primary" href="{{ url('/savaktTerpi'.$td->KostimiID) }}">Savākt</a></td>
                </tr>
                @endforeach
                @endif
            </tbody>
</table>
    </div>

    <div class="container">
<table class="table">  
@if (isset($ld) && $ld !== null && (session('LomaID') == 0 || session('LomaID') == 3))
<thead> 
<th style="font-size: larger">Dati:</th>
</thead>
<tbody>
<!--forma-->
<th>
    <form action="dataUpdateLietotaji{{ $ld->personasKods }}" method="post" enctype="multipart/form-data">
      @csrf <!--note to self: Cross-Site Request Forgery ir drošības metode, kas tiek izmantota, lai aizsargātu lietotājus no kaitīgas rīcības, kas saistīta ar krāpšanos ar pieprasījumiem no citas vietnes.-->
      <div class="form-group">
          <label for="Vards">Vārds:</label>
          <input type="text" class="form-control" name="Vards" value="{{ $ld->Vards }}">
      </div>
      <div class="form-group">
          <label for="Uzvards">Uzvārds:</label>
          <input type="text" class="form-control" name="Uzvards" value="{{ $ld->Uzvards }}">
      </div>
      <div class="form-group">
          <label for="Epasts">E-pasts:</label>
          <input type="email" class="form-control" name="Epasts" value="{{ $ld->Epasts }}">
      </div>
      <div class="form-group">
          <label for="Parole">Parole:</label>
          <input type="password" class="form-control" name="Parole" value="{{ $ld->Parole }}">
      </div>
      <div class="form-group">
          <label for="Talrunis">Tālrunis:</label>
          <input type="tel" class="form-control" name="Talrunis" value="{{ $ld->Talrunis }}">
      </div>

      <button type="submit" class="btn btn-primary">Saglabāt</button>
    </form>
    @endif

</th>
</tbody>
</table>
</div>



  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu">
