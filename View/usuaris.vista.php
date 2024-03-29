<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>llistat de grups</title>
     <!-- BOOTSTRAP -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
 
     
     <!-- JS -->
     <script type="module" src="../Assets/js/funcions.js"></script>
     <script type="module" src="../Assets/js/usuaris.js"></script>
      <script defer src="../Assets/js/global.js"></script>

    <!-- leer Excel con js -->
    <script src="https://unpkg.com/read-excel-file@5.x/bundle/read-excel-file.min.js"></script>


    <!-- CSS -->
    <link rel="stylesheet" href="../Assets/Css/users.style.css" />
    <link rel="stylesheet" href="../Assets/Css/global.css" />

     <!-- link google Font -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
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
              <a class="nav-link" href="../Controller/material.php">Material</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#"><b>Usuaris</b></a>
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
            <h1>Usuaris</h1>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-center" style="gap: 10px;">
     
        <!-- Si no funciona el DropDown es por una clase de boostrap llamada clase="dropdown" -->
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" name="dropdownMenuButton">
            Filtrar
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li></li>
            <li><a class="dropdown-item" id="filtrarLletra" name="mostrarMaterial">A-Z</a></li>
            <li><a class="dropdown-item" id="filtrarCurs" name="filtrarCurs">Per Curs</a></li>
            <li><a class="dropdown-item" id="filtrarEdat" name="filtrarEdat">Per Edat</a></li>
          </ul>
        <input type="text" id="nomUsuari" name="nomUsuari" aria-label="Nom Usuari" placeholder="Filtrar Nom Usuari" required>
        <button type="submit" class="btn btn-primary" id="AfegirUsuari" name="AfegirUsuari">Afegir Nou Usuari</button>
       
    
    </div>

    <div class="m-5">
      <input type="file" id="excelFile" class="form-control">     
      <button type="submit" class="mt-3" id="clearStorage">Borrar tot el llistat</button>
    </div>
    
    <div id="taulaAlumnes" class="d-flex justify-content-center">
        <table id="Alumnes">
          
            <!-- Agrega más alumnos según sea necesario -->
        </table>
    </div>
    
    <dialog  id="newF">
      <h3>Usuari</h3>
      <table id="newUserTable">

          <tr>
              <th>Nom</th>
              <td><input type="text" id="newNom" required placeholder="Nom"></td>
          </tr>
          <tr>
              <th>Cognom</th>
              <td><input type="text" id="newCognom" required placeholder="Cognom"></td>
          </tr>
          <tr>
              <th>Edat</th>
              <td><input type="text" id="Edat" required placeholder="Edat"></td>
          </tr>
          <tr><th class="spacing"></th></tr>
          <tr>
              <th>Curs</th>
              <td><select id="Curs">
                <option value="ASIX1">ASIX1</option>
                <option value="ASIX2">ASIX2</option>
                <option value="DAW1">DAW1</option>
                <option value="DAW2">DAW2</option>
                <option value="SMX1">SMX1</option>
                <option value="SMX2">SMX2</option>
             
              </select></td>
          </tr>
          <tr><th class="spacing"></th></tr>
      </table>
      <div id="newFGuardar"><button id="Guardar">Guardar</button></div>
      <div id="NewBorrar"><button id="borrar">Eliminar</button></div>

  </dialog>


  </body>
  
</html>
