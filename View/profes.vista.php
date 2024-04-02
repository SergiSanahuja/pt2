<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professors</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>  
    
    <!-- CSS -->
    <link rel="stylesheet" href="../Assets/Css/profes.style.css">
    <link rel="stylesheet" href="../Assets/Css/global.css" />

    <!-- link google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">

    <!--Taula-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>

    <!-- JS -->
    <script defer src="../Assets/js/profes.js"></script>
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
            <a class="nav-link active" href="#"><b>Tallers</b></a>

          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Controller/material.php">Material</a>
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
              if (isset($_SESSION['admin'])) {
                ?>
                  <li class="nav-item">
                    <a class="nav-link" href="../Controller/profes.php">Professors</a>
                  </li>
                <?php
              }
            ?>
            
        </ul>
        
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
            <?php 
              if(session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
              }
              if (isset($_SESSION['admin'])) {
                ?>
                  <li class="nav-item">
                    <a class="nav-link" href="../Controller/AcabarActivitats.php"><button id="Acabar" class="btn mt-2 btn-primary">Acabar Activitats</button></a>
                  </li>
                <?php
              }
            ?>
            </li> 
          <li class="nav-item">
              <button type="button" class="btn btn-primary" id="canviarContrasenya">Canviar contrasenya</button>
              <button class="btnLogOut" id="btnTancarSessio">Tancar sessió</button>
          </li>
        </ul>
      </div>
    </nav>
          
        <h1 class="row justify-content-center m-5">Professors</h1>
        <!--2 buttons para abrir dialog -->
        <div class="col-12 text-center-md text-center">
          <button type="button" class="btn2 btn btn-primary" id="btnAfegirProfe" name="btnAfegirProfe">Afegir Professor</button>
          <button type="button" class="btn2 btn btn-primary" id="btnModificarProfe" name="btnModificarProfe">Modificar Professor</button>
          <button type="button" class="btn2 btn btn-danger" id="btnEliminarProfe" name="btnEliminarProfe">Eliminar Professor</button>
        </div>
        <h2 class="row justify-content-center m-5">Llista de professors</h2>
        <div class="container mt-5">
                <table id="myTable" class="display table table-striped table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Cognom</th>
                    <th>Email</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    //funcio per mostrar els professors
                    
                    mostrarProfes();
                  ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--Dialogs-->
    <dialog id="afegirProfesDialog" class="DialogProfes">
      <div class="centrat popUpProfes">
        <img id="tancarAfegirProfes" class="tancar" src="../Assets/img/close.svg">
        <h2>Afegir Professor</h2>
        <form method="post" enctype="multipart/form-data" id="formulariAfegirProfes">
          <label for="nomProfesAfegir">Nom del professor</label>
          <input type="text" id="nomProfesAfegir" name="nomProfesAfegir" required><br><br>
          <label for="cognomProfesAfegir">Cognom</label>
          <input type="text" id="cognomProfesAfegir" name="cognomProfesAfegir" required><br><br>
          <label for="emailProfesAfegir">Email</label>
          <input type="email" id="emailProfesAfegir" name="emailProfesAfegir" required><br><br>
          <label for="passwordProfesAfegir">Password</label>
          <input type="password" id="passwordProfesAfegir" name="passwordProfesAfegir" required><br><br>
          <button type="submit" class="btn btn-primary" id="agregarProfes" name="agregarProfes">Afegir</button>
        </form>
      </div>
    </dialog>

    <dialog id="modificarProfesDialog" class="DialogProfes">
      <div class="centrat popUpProfes">
        <img id="tancarModificarProfes" class="tancar" src="../Assets/img/close.svg">
        <h2>Modificar Professor</h2>
        <form method="post" enctype="multipart/form-data" id="formulariModificarProfes">
          <label for="idProfesModificar">Id del professor a modificar</label>
          <input type="text" id="idProfesModificar" name="idProfesModificar" required><br><br>
          <label for="nomProfesModificar">Nom del professor</label>
          <input type="text" id="nomProfesModificar" name="nomProfesModificar"><br><br>
          <label for="cognomProfesModificar">Cognom</label>
          <input type="text" id="cognomProfesModificar" name="cognomProfesModificar"><br><br>
          <label for="emailProfesModificar">Email</label>
          <input type="email" id="emailProfesModificar" name="emailProfesModificar"><br><br>
          <label for="passwordProfesModificar">Password</label>
          <input type="password" id="passwordProfesModificar" name="passwordProfesModificar"><br><br>
          <button type="submit" class="btn btn-primary" id="btnModifyProfes" name="btnModifyProfes">Modificar</button>
        </form>
      </div>
    </dialog>

    <dialog id="eliminarProfesDialog" class="DialogProfes">
      <div class="centrat popUpProfes">
        <img id="tancarEliminarProfes" class="tancar" src="../Assets/img/close.svg">
        <h2>Eliminar Professor</h2>
        <form method="post" enctype="multipart/form-data" id="formulariEliminarProfes">
          <label for="idProfesEliminar">Id del professor a eliminar</label>
          <input type="text" id="idProfesEliminar" name="idProfesEliminar" required><br><br>
          <button type="submit" class="btn btn-primary" id="eliminarProfes" name="eliminarProfes">Eliminar</button>
        </form>
      </div>
    </dialog>
</body>
</html>