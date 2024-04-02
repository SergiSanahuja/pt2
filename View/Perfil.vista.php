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
      <link rel="stylesheet" href="../Assets/Css/Perfil.css">
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
                  <a class="nav-link" href="alumnes.activitats.php">Activitats</a>
                </li>
               
              </ul>
              
              <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <button class="btnLogOut" id="btnTancarSessio">Tancar sessió</button>
                </li>
                <li>
                <div class="configuracio">
                    <a href="Controller/perfil.conf.php">Perfil</a>
                </div>
                </li>
              </ul>
            </div>
          </nav>

    <div class="container">
        <div class="row">
            <div class="justify-content-center">
        
                <h1>Perfil</h1>

            </div>
        </div>
        <div class="">
            <div class="col-md-8 col-sm-10 offset-2 offset-md-4 ">

                <div class="info ">
                    
                    <form action="perfil.conf.php" method="POST">
                        <div class="form-group ">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $grup->nom ?>">
                            <input type="file" class="form-control" id="fotoPerfil" name="fotoPerfil">
                        </div>
                        <button class="m-3 enviar" type="submit">Canviar</button>
                    </form>
                    
                </div>
            </div>
        </div>
</body>
</html>