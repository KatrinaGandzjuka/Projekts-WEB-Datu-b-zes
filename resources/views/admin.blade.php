<!DOCTYPE html>
<html lang="lv">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lietotāja pievienošana | Admins</title>
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
              <a class="nav-link" style="color:#3a88fe;" href="/">pievienot lietotāju</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/viewLietotaji">lietotāju saraksts</a>
            </li>
          </ul>
        </div>
      </nav>






  <!--forma-->
  <div class="container">
    <form action="dataInsert" method="post" enctype="multipart/form-data">
      @csrf <!--note to self: Cross-Site Request Forgery ir drošības metode, kas tiek izmantota, lai aizsargātu lietotājus no kaitīgas rīcības, kas saistīta ar krāpšanos ar pieprasījumiem no citas vietnes.-->
      <div class="form-group">
          <label for="personasKods" class="control-label">Personas kods:</label>
          <input type="text" class="form-control" name="personasKods" placeholder="Ievadiet personas kodu" required autofocus>
      </div>
      <div class="form-group">
          <label for="Vards">Vārds:</label>
          <input type="text" class="form-control" name="Vards" placeholder="Ievadiet vārdu" required autofocus>
      </div>
      <div class="form-group">
          <label for="Uzvards">Uzvārds:</label>
          <input type="text" class="form-control" name="Uzvards" placeholder="Ievadiet uzvārdu" required autofocus>
      </div>
      <div class="form-group">
          <label for="Epasts">E-pasts:</label>
          <input type="email" class="form-control" name="Epasts" placeholder="Ievadiet e-pastu" required autofocus>
      </div>
      <div class="form-group">
          <label for="Parole">Parole:</label>
          <input type="password" class="form-control" name="Parole" placeholder="Ievadiet paroli" required autofocus>
      </div>
      <div class="form-group">
          <label for="Talrunis">Tālrunis:</label>
          <input type="tel" class="form-control" name="Talrunis" placeholder="Ievadiet tālruņa numuru" required autofocus>
      </div>
      <div class="form-group">
        <label for="dzimDiena">Dzimšanas diena:</label>
        <input type="date" class="form-control" name="dzimDiena" required autofocus>
      </div>
      <div class="form-group">
        <label for="LomaID">Loma:</label>
        <select class="form-control" name="LomaID">
          <option value="1">Audzēknis</option>
          <option value="2">Vecāks</option>
          <option value="3">Pedagogs</option>
          <option value="0">Administrators</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Pievienot lietotāju</button>
    </form>
  </div>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu">

    