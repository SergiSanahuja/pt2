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
     <link rel="stylesheet" href="../Assets/Css/global.css" />

      <!-- link google Font -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">

     <!--SCRIPTS-->
      <script defer src="../Assets/js/material.js"></script>
      <script defer src="../Assets/js/global.js"></script>
</head>
<body>
    <div class="container-12">
    <nav class="navbar navbar-expand-lg ">
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
                  <a class="nav-link active" href="#"><b>Material</b></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../Controller/usuaris.php">Usuaris</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../Controller/grups.php">Grups</a>
                </li>
                <?php 
                   if(session_status() !== PHP_SESSION_ACTIVE) {
                    session_start();
                  }
                  if (isset($_SESSION['email'])) {
                    $correo = $_SESSION['email'];
                    if ($correo === 'admin@example.com') { ?>
                      <li class="nav-item">
                        <a class="nav-link" href="../Controller/crearProfes.php">Crear professors</a>
                      </li>
                    <?php }
                  }
                ?>
              </ul>
              <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <button class="btnLogOut" id="btnTancarSessio">Tancar sessió</button>
                </li>
              </ul>
            </div>
          </nav>
          <div class="row-12">
            <div class="col-12 text-center-md text-center">
                <h1>Material</h1>
                <!--Desplegable para filtrar-->
                <div class="d-flex align-items-center justify-content-center" style="gap: 10px;">
                  <form method="post" enctype="multipart/form-data" id="formulariMaterial">
                    <!-- Si no funciona el DropDown es por una clase de boostrap llamada clase="dropdown" -->

                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" name="dropdownMenuButton">
                        Filtrar
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li></li>
                        <li><a class="dropdown-item" href="?filtrar=nom" id="filtrarLletra" name="mostrarMaterial">Per lletra</a></li>
                        <li><a class="dropdown-item" href="?filtrar=quantitat" id="filtrarQuantitat" name="filtrarQuantitat">Per quantitat</a></li>
                      </ul><br><br>

                    <button type="button" class="btn btn-primary" id="btnAfegirMatDialog" name="btnAfegirMatDialog">Afegir Material</button>
                    <button type="button" class="btn btn-primary" id="btnModificarMatDialog" name="btnModificarMatDialog">Modificar Material</button>
                    <button type="button" class="btn btn-primary" id="btnEliminarMatDialog" name="btnEliminarMatDialog">Eliminar Material</button>
                  </form>
                </div>
                <!--DIV -->
                <div class="container d-flex flex-wrap justify-content-center mt-4">
                    <!--Cards-->
                    <?php
                    echo mostrarMaterial($_GET["filtrar"] ?? "default");
                    ?>
                </div>
            </div> 
        </div>
    </div>
    <dialog id="afegirMaterialDialog" class="DialogMaterial">
      <div class="centrat popUpMaterial">
        <img id="tancarAfegirMat" class="tancar" src="../Assets/img/close.svg">
        <h2>Afegir Material</h2>
        <form method="post" enctype="multipart/form-data" id="formulariAfegirMaterial">
          <label for="nomMaterialAfegir">Nom del material</label>
          <input type="text" id="nomMaterialAfegir" name="nomMaterialAfegir" required><br><br>
          <label for="quantitatMaterialAfegir">Quantitat</label>
          <input type="number" id="quantitatMaterialAfegir" name="quantitatMaterialAfegir" required min="1" value="1"><br><br>
          <label for='arxiuUsuariAfegir' class='btn btn-primary' >Inserir imatge</label>
          <input id='arxiuUsuariAfegir' type="file" class="btn btn-primary" name="arxiuUsuariAfegir"><br><br>
          <label for="pagatAfegirMat">S'ha de comprar?</label>
          <input type="checkbox" id="pagatAfegirMat" name="pagatAfegirMat"><br><br>
          <button type="submit" class="btn btn-primary" id="agregarMaterial" name="agregarMaterial">Afegir</button>
        </form>
      </div>
    </dialog>
    <dialog id="modificarMaterialDialog" class="DialogMaterial">
      <div class="centrat popUpMaterial">
        <img id="tancarModificarMat" class="tancar" src="../Assets/img/close.svg">
        <h2>Modificar Material</h2>
        <form method="post" enctype="multipart/form-data" id="formulariModificarMaterial">
          <label for="nomMaterialModificar">Nom del material a modificar</label>
          <input type="text" id="nomMaterialModificar" name="nomMaterialModificar" required><br><br>
          <label for="quantitatMaterialModificar">Quantitat</label>
          <input type="number" id="quantitatMaterialModificar" name="quantitatMaterialModificar" required min="0" value="0"><br>
          <p class="colorNotification">(Si vols canviar solament l'imatge, pots posar la quantitat a 0)</p>
          <label for='arxiuUsuariModificar' class='btn btn-primary' >Inserir imatge</label>
          <input id='arxiuUsuariModificar' type="file" class="btn btn-primary" name="arxiuUsuariModificar"><br><br>
          <label for="pagatModificarMat">S'ha de comprar?</label>
          <input type="checkbox" id="pagatModificarMat" name="pagatModificarMat"><br><br>
          <button type="submit" class="btn btn-primary" id="modificarMaterial" name="modificarMaterial">Modificar</button>
        </form>
      </div>
    </dialog>
    <dialog id="eliminarMaterialDialog" class="DialogMaterial">
      <div class="centrat popUpMaterial">
        <img id="tancarEliminarMat" class="tancar" src="../Assets/img/close.svg">
        <h2>Eliminar Material</h2>
        <form method="post" enctype="multipart/form-data" id="formulariEliminarMaterial">
          <label for="nomMaterialEliminar">Nom del material a eliminar</label>
          <input type="text" id="nomMaterialEliminar" name="nomMaterialEliminar" required><br><br>
          <button type="submit" class="btn btn-primary" id="eliminarMaterial" name="eliminarMaterial">Eliminar</button>
        </form>
      </div>
    </dialog>
</body>
</html>