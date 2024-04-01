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

    <!-- CSS -->
    <link rel="stylesheet" href="../Assets/Css/grups.style.css" />
    <link rel="stylesheet" href="../Assets/Css/global.css" />

    <!-- JS -->
    <script type="module" src="../Assets/js/grups.js"></script>
    <script defer src="../Assets/js/global.js"></script>

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
              <a class="nav-link" href="../Controller/usuaris.php">Usuaris</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#"><b>Grups</b></a>
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
            <h1>Grups</h1>
            <p>Posa el número de grups que vols crear:</p>
            <p>Per actualitzar has de recargar la pàgina</p>
        <div class="llistaGrups">
          <input type="number" id="numDeUsersXGrup" min="0"  value="0">
          <button type="button" id="crearGrups" >Realitzar sorteig</button>
        </div>          
            
        <div class="container">

          <div id="llistatGrups" class="justify-content-center row ">

          </div>
        </div>
      
      </div>

      </div>
    </div>
  </body>
</html>
