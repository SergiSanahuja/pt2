<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

     <!-- BOOTSTRAP -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

     <!-- CSS -->
     <link rel="stylesheet" href="../Assets/Css/material.style.css">
</head>
<body>
    <div class="container-12">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <img src="../Assets/img/logo.png" alt="logo" width="auto" height="50">
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarText">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="../Controller/home.php">Tallers</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="#">Material</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../Controller/usuaris.php">Usuaris</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../Controller/grups.php">Grups</a>
                </li>
                <li>
                    <div class="cercle"></div>
                </li>
              </ul>
            </div>
          </nav>

          <div class="row">
            <div class="col-12 text-center-md text-center">
                <h1>Material</h1>
                <!--Desplegable para filtrar-->
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                      Filtrar
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <li><a class="dropdown-item" href="#">Per lletra</a></li>
                      <li><a class="dropdown-item" href="#">Per quantitat</a></li>
                    </ul>
                </div><br>
                <div>
                    <label for="nomMaterial">Nom material</label>
                    <input type="text" id="nomMaterial" name="nomMaterial">
                    <input type="number" id="quantitatMaterial" name="quantitatMaterial" value="1" min="1">
                    <label for='arxiuPujat' class='btn btn-primary'>Search...</label>
                    <input id='arxiuPujat' type="file" class="btn btn-primary">
                    <button type="button" class="btn btn-primary" id="agregarAgregar">+</button>
                    <button type="button" class="btn btn-primary" id="eliminarMaterial">-</button>
                </div>
                <!--DIV -->

                <div>
                    <!--Cards-->
                    <div class="card" style="width: 18rem;">
                        <img src="<?php  ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Material 1</h5>
                            <p class="card-text">Quantitat: 10</p>
                        </div>
                    </div>
                </div>
            </div> 
</body>
</html>