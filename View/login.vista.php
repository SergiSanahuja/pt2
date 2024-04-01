<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="../Assets/Css/login.style.css">
</head>
<body>
    <div class="container-12">
        <h1>LogIn</h1>
        <div class="container">
            <form action="../Controller/login.php" method="post">
                   <div class="row">
                        <div class="col-12 col-md-12">
                            <label for="correu">Correu Grup:</label>
                            <input type="email" name="correu" id="correu" class="form-control" required>
                        </div>
                        <div class="col-12 col-md-12 mb-4">
                            <label for="pass">Contrasenya:</label>
                            <input type="password" name="pass" id="pass" class="form-control" required>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-danger" name="submit">LogIn</button> 
                        </div>
                   </div>
            </form>
        </div>
    </div>
    
</body>
</html>