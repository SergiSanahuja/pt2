<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canviar Contrasenya</title>

      <!-- BOOTSTRAP -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
 
      <!-- CSS -->
      <link rel="stylesheet" href="../Assets/Css/global.css" />

      <!-- link google Font -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">

      <!--SCRIPTS-->
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
          <li class="nav-item">
            <a class="nav-link" href="../Controller/home.php">Tallers</a>

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
              <button type="button" class="btnLogOut" id="btnTancarSessio">Tancar sessió</button>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
        <h1 class="mt-5">Canviar Contrasenya</h1>
        <form action="../Controller/canviarContrasenya.php" method="post">
            <div class="row">
                <div class="col-12 col-md-12 mt-5">
                    <label for="passActual">Contrasenya actual:</label>
                    <input type="password" name="passActual" id="passActual" class="form-control" required>

                    <label for="pass" class="mt-2">Nova contrasenya:</label>
                    <input type="password" name="pass" id="pass" class="form-control" required>

                    <label for="pass2" class="mt-2">Repeteix la nova contrasenya:</label>
                    <input type="password" name="pass2" id="pass2" class="form-control" required>

                    <button type="submit" class="btn btn-danger mt-3" name="btnCanviarContrasenya">Canviar contrasenya</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>