<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>

  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
    crossorigin="anonymous"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="../Assets/Css/home.style.css">
  <link rel="stylesheet" href="../Assets/Css/global.css">
  <!-- link google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
  <!-- JS -->
  <script src="../Assets/js/funcions.js"></script>
  <script type="module" src="../Assets/js/funcions_tallers.js"></script>
  <script src="../Assets/js/mapcontrol.js"></script>
  <script src="../Assets/js/mapcontrolModal.js"></script>
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
            <a class="nav-link active" href="#">Tallers</a>

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
        <h1>Tallers</h1>
        <!-- Botón para activar el modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTaller">
          Afegir taller
        </button>

        <!-- Tabla de talleres -->
        <div class="d-flex justify-content-start"></div>
        <div class="table-responsive">
          <table id="talleresTable" class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Material</th>
                <th>Profesor</th>
              </tr>
            </thead>
            <tbody>
              <!-- Las filas de la tabla se llenarán con JavaScript -->
            </tbody>
          </table>
        </div>

        <!-- Modal -->

       <!-- Modal para añadir taller -->
        <div class="modal fade" id="modalTaller" tabindex="-1" aria-labelledby="modalTallerLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalTallerLabel">Afegir Taller</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div id="modalMap" style="height: 300px; width: 450px;"></div>
                <p>Per afegir un marcador, fes clic al mapa després de prémer.</p>
                <button type="button" class="btn btn-warning" id="btnMapaEliminarUltimoMarcador">
                  Eliminar últim marcador
                </button>
                <form id="form">
                    <div class="mb-3">
                        <input class="form-control" type="text" id="nom" name="nom" aria-label="Nom del taller"
                            placeholder="Nom del taller">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" id="professor" name="professor"
                            aria-label="Nom del professor responsable" placeholder="Professor">
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="file" id="fil" name="fil" aria-label="Imatge del taller"
                            placeholder="img">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" id="material" name="material" aria-label="Material"
                            placeholder="Material" rows="3"></textarea>
                    </div>
                    <input type="hidden" id="modalLat" name="lat">
                    <input type="hidden" id="modalLng" name="lng">
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelar">Cancelar</button>
                <button type="button" class="btn btn-primary" id="afegirTaller">Afegir Taller</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modalEditarTaller" tabindex="-1" aria-labelledby="modalEditarTallerLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalEditarTallerLabel">Editar Taller</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div id="editarModalMap" style="height: 300px; width: 450px;"></div> 
                <form id="formEditar">
                  <input type="hidden" id="editarId" name="id">
                  <input type="hidden" id="formState" value="new">
                  <input type="hidden" id="editingTallerId">
                  <div class="mb-3">
                    <label for="editarNom" class="form-label">Nombre del Taller:</label>
                    <input class="form-control" type="text" id="editarNom" name="nom">
                  </div>
                  <div class="mb-3">
                    <label for="editarProfessor" class="form-label">Profesor:</label>
                    <input class="form-control" type="text" id="editarProfessor" name="professor">
                  </div>
                  <div class="mb-3">
                    <label for="editarMaterial" class="form-label">Material:</label>
                    <textarea class="form-control" id="editarMaterial" name="material" rows="3"></textarea>
                  </div>
                  <input type="hidden" id="editarLat" name="lat">
                  <input type="hidden" id="editarLng" name="lng">
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="actualizarCambiosTaller">Actualizar Cambios</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12">
      <div id="mapa" class="mapa"></div>
      <p id="explicacion">Fes clic a un marcador del mapa para ver +info</p>
    </div>
</div>
</body>

</html>