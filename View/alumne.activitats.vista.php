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
                  <a class="nav-link active" href="alumnes.activitats.php">Activitats</a>
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
        <div class="row">
            <div class="col-12">
                <h1>Activitats</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Professor</th>
                            <th>Accions</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($activitats as $activitat): ?>
                            <tr>
                               
                                <td><?php echo $activitat->nom ?></td>
                                <td><?php echo $activitat->professor ?></td>
                                <td>
                                    <?php echo is_array($nomGrups[0][0]) ? $nomGrups[0][0]['nom'] : 'N/A';  ?>
                                    <?php echo '-' ?>
                                    <?php echo is_array($nomGrups[0][1]) ? $nomGrups[0][1]['nom'] : 'N/A';  ?>
                                </td>
                                
                               
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</body>
</html>