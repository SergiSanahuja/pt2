<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../Assets/Css/global.css">
    <!-- link google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">

      <!-- JS -->
      <script defer src="../Assets/js/global.js"></script>

      <!-- css -->
      <link rel="stylesheet" href="../Assets/Css/diploma.css">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>    

</head>
<body>
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
    <div class="diploma">
        <h1>Certificat</h1>
        <h2>Guanyadors de les Activitats </h2>
        <h3><?php echo $guanyador->nom  ?></h3>
        <img  src="../Assets/img/grups/<?php echo $guanyador->image ?>" alt="imatgeGrup" width="300" height="300">
        
        <p><?php echo date("d/m/Y"); ?></p>
        <p>Firma del Instructor</p>
    </div>

    
</body>
</html>