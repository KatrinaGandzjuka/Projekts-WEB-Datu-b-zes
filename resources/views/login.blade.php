<!DOCTYPE html>
<html lang="lv">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pieslēgšanās</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
  </head>
  <body>
    <!--Navigācija-->
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand">Pieslēgšanās</a>
    </nav>
    <!--forma-->
    <div class="container">
      <form action="loginPost" method="post" enctype="multipart/form-data"> @csrf
        <!--note to self: Cross-Site Request Forgery ir drošības metode, kas tiek izmantota, lai aizsargātu lietotājus no kaitīgas rīcības, kas saistīta ar krāpšanos ar pieprasījumiem no citas vietnes.-->
        <div class="form-group">
          <label for="personasKods" class="control-label">Personas kods:</label>
          <input type="text" class="form-control" name="personasKods" placeholder="Ievadiet personas kodu" required autofocus>
        </div>
        <div class="form-group">
          <label for="Parole">Parole:</label>
          <input type="password" class="form-control" name="Parole" placeholder="Ievadiet paroli" required autofocus>
        </div>
        <div class="form-text">Neskaidrību gadījumā lūgums vērsties pie administrātora</div>
        <button type="submit" class="btn btn-primary">Ienākt</button>
      </form>
    </div>