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
      <link rel="stylesheet" href="../Assets/Css/alumne.activitats.css">

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
              
                <li class="nav-item">
                  <a class="nav-link " href="alumnes.activitats.php">Activitats</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="alumnes.grup.php">Grup</a>
                </li>
              </ul>
              
              <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <button class="btnLogOut" id="btnTancarSessio">Tancar sessió</button>
                </li>
                <li>
                <div class="configuracio">
                    <a href="perfil.conf.php">Perfil</a>
                </div>
                </li>
              </ul>
            </div>
          </nav>
    <div class="container">

      <div class="row justify-content-between">
          <div class="col">
            <h1>Alumnes del  <?php echo is_object($grup) ? $grup->titol : 'N/A'; ?></h1>
            <img src="../Assets/img/grups/<?php echo is_object($grup) ? $grup->image : 'N/A'; ?>" alt="imatgeGrup" width="200" height="200">
          </div>
          <div class="col-12">
              <h2>Puntuacio:  <?php echo is_object($puntuacio) ? $puntuacio->punts : 'N/A'; ?></h2>
          </div>
      </div>  
      <div class="row">
        <?php foreach($UsuarisGrup as $alumne): ?>
        <div class="col-3 mb-1">
          <div class="card">
            <div class="card-body">
                        <h5 class="card-title"><?php echo is_array($alumne) ? $alumne['nom'] : 'N/A'; ?></h5>
                        <p class="card-text"><?php echo is_array($alumne) ? $alumne['cognom'] : 'N/A'; ?></p>
                        <p class="card-text"><?php echo is_array($alumne) ? $alumne['curs'] : 'N/A'; ?></p>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                  
      </div>

    
</body>
</html>