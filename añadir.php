  <html>
  <?php
    session_start();
    include 'dbconf.php';
    include_once 'header.php';
    ?>

  <head>
      <title>Añadir</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <!-- Bootstrap CSS -->
      <link href="bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
      <!--hoja de estilos para el menu-->
      <link href="assets/css/menu.css" rel="stylesheet">
  </head>
  <body>
      <?php
        menu();
        addAlumno();
        function addAlumno()
        {
        ?>
          <div class="container">
              <div class="row justify-content-sm-center h-100">
                  <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                      <div class="text-center my-5">
                          <p class="display-6">Insertar alumnos</p>
                      </div>
                      <div class="card shadow-lg">
                          <div class="card-body p-5">
                              <h1 class="fs-4 card-title fw-bold mb-4">Creación de alumno</h1>
                              <form method="POST" action="añadir.php">
                                  <div class="mb-3">
                                      <label class="mb-2 text-muted" for="nombre">Nombre</label>
                                      <input id="user" type="text" class="form-control" name="nombre" required autofocus>

                                  </div>
                                  <div class="mb-3">
                                      <label class="mb-2 text-muted" for="apellidos">Apellidos</label>
                                      <input id="user" type="text" class="form-control" name="apellidos" required autofocus>

                                  </div>
                                  <div class="mb-3">
                                      <label class="mb-2 text-muted" for="dni">Dni</label>
                                      <input id="dni" type="text" class="form-control" name="dni" required autofocus>

                                  </div>
                                  <div class="mb-3">
                                      <label class="mb-2 text-muted" for="nombre">Fecha de nacimiento</label>
                                      <input id="fechaNacimiento" type="date" class="form-control" name="fechaNacimiento" required autofocus>

                                  </div>
                                  <div class="mb-3">
                                      <label class="mb-2 text-muted" for="idTipoVia">IdTipoVia</label>
                                      <select id="idTipoVia" name="idTipoVia" class="form-control">
                                          <option name="opciones" value="calle">calle</option>
                                          <option name="opciones" value="avenida">avenida</option>
                                          <option name="opciones" value="interurbana">interurbana</option>
                                      </select>

                                  </div>
                                  <div class="mb-3">
                                      <label class="mb-2 text-muted" for="nombreVia">Nombre de la via</label>
                                      <input id="user" type="text" class="form-control" name="nombreVia" required autofocus>

                                  </div>
                                  <div class="mb-3">
                                      <label class="mb-2 text-muted" for="numeroVia">Número de vía</label>
                                      <input id="user" type="number" class="form-control" name="numeroVia" required autofocus>

                                  </div>
                                  <div class="mb-3">
                                      <label class="mb-2 text-muted" for="localidad">Localidad</label>
                                      <input id="user" type="text" class="form-control" name="localidad" required autofocus>

                                  </div>
                                  <div class="mb-3">
                                      <label class="mb-2 text-muted" for="telefono">Numero de telefono</label>
                                      <input id="user" type="number" class="form-control" name="telefono" required autofocus>

                                  </div>
                                  <p class="form-text text-muted mb-3">
                                      Una vez rellenado todos los campos ,el alumno se insertará a la base de datos
                                  </p>

                                  <div class="align-items-center d-flex">
                                      <button type="submit" value="enviar" name="enviar" class="btn btn-primary ms-auto">enviar</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                      <div class="text-center mt-5 text-muted">
                          Menu realizado con php , css3 , html, javaScript y Bootsrap
                      </div>
                  </div>
              </div>
          </div>
      <?php
            if (isset($_POST['enviar'])) {
                $con = mysqli_connect(host, user, pass) or die("No se ha podido conectar al servidor de Base de datos");
                $db = mysqli_select_db($con, 'escuela') or die("no se ha podido conectar a la base de datos");
                $consulta = "INSERT INTO alumnos (nombre,apellidos,dni,fechaNacimiento,idTipoVia,nombreVia,numeroVia,localidad,telefono)
                 VALUES(?,?,?,?,?,?,?,?,?)";

                $stmt = mysqli_stmt_init($con); //inicializar
                if (mysqli_stmt_prepare($stmt, $consulta)) {
                    mysqli_stmt_bind_param($stmt, "ssssssisi", $nombre, $apellidos, $dni, $fechaNacimiento, $idTipoVia, $nombreVia, $numeroVia, $localidad, $telefono);

                    $nombre = $_POST['nombre'];
                    $apellidos = $_POST['apellidos'];
                    $dni = $_POST['dni'];
                    $fechaNacimiento = $_POST['fechaNacimiento'];
                    $idTipoVia = $_POST['idTipoVia'];
                    $nombreVia = $_POST['nombreVia'];
                    $numeroVia = $_POST['numeroVia'];
                    $localidad = $_POST['localidad'];
                    $telefono = $_POST['telefono'];
                    var_dump($idTipoVia);

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt); //siempre que haya un statement abierto hay que cerrarlo
                }
            }
        }
        ?>
      <script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>

  </body>

  </html>