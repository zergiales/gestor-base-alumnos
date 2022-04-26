  <html>

  <head>
      <title>Registrar</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <!-- Bootstrap CSS -->
      <link href="../bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>  
    <div class="container h-100">
          <div class="row justify-content-sm-center h-100">
              <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                  <div class="text-center my-5">
                      <p class="display-6">Registrate con nosotros</p>
                  </div>
                  <div class="card shadow-lg">
                      <div class="card-body p-5">
                          <h1 class="fs-4 card-title fw-bold mb-4">Registro de usuarios</h1>
                          <form method="POST" action="insertarUsuario.php">
                              <div class="mb-3">
                                  <label class="mb-2 text-muted" for="usuario">usuario</label>
                                  <input id="user" type="text" class="form-control" name="user" required autofocus>
                                  <div class="invalid-feedback">
                                      no has puesto un nombre de usuario
                                  </div>
                              </div>
                              <div class="mb-3">
                                  <label class="mb-2 text-muted" for="password">Password</label>
                                  <input id="password" type="password" class="form-control" name="password" required>
                                  <div class="invalid-feedback">
                                      Password is required
                                  </div>
                              </div>
                              <div class="mb-3">
                                  <label class="mb-2 text-muted" for="permisos">Permisos</label>
                                  <!--el usuario no tiene que poner la fecha -->
                                  <select id="permisos" name="permisos" class="form-control">
                                      <option value="visor">visor</option>
                                      <option value="admin">admin</option>
                                  </select>
                                  <div class="invalid-feedback">
                                      selecione el tipo de permisos
                                  </div>
                              </div>
                              <p class="form-text text-muted mb-3">
                                  Una vez registrado , se supone que has aceptado los terminos y condiciones
                              </p>

                              <div class="align-items-center d-flex">
                                <button type="submit" value="enviar" name="enviar" class="btn btn-primary ms-auto">enviar</button>
                              </div>
                          </form>
                      </div>
                      <div class="card-footer py-3 border-0">
                          <div class="text-center">
                              ¿Ya tenías una cuenta antes? <a href="../index.php" class="text-dark">Iniciar sesion</a>
                          </div>
                      </div>
                  </div>
                  <div class="text-center mt-5 text-muted">
                      Menu realizado con php , css3 , html, javaScript y Bootsrap
                  </div>
              </div>
          </div>
      </div>
    <?php
        //parte de inyeccion de sql
        if (isset($_POST['enviar'])) {
            include'../dbconf.php';
            // creación de la conexión a la base de datos con mysql_connect()
            //uso del or die para mostrar un mensaje si algo va mal 
            $con = mysqli_connect(host, user, pass) or die("No se ha podido conectar al servidor de Base de datos");
            // Selección del a base de datos a utilizar
            $db = mysqli_select_db($con, 'escuela') or die("no se ha podido conectar a la base de datos");
            // establecer y realizar consulta. guardamos en variable.
            $consulta = "INSERT INTO usuarios (usuario,password,permisos,fechaAlta) VALUES (?,?,?,?)";//consulta preparada para insertar los usuarios

            $stmt = mysqli_stmt_init($con); //inicializo
            if (mysqli_stmt_prepare($stmt, $consulta)) {
                mysqli_stmt_bind_param($stmt, "ssss", $usuario, $encriptado, $permisos, $fechaAlta);
                //esto se hace despues de montar

                $usuario = $_POST['user'];
                $encriptado = password_hash($_POST['password'], PASSWORD_BCRYPT);//funcion para encriptar la contraseña y la haseamos
                $permisos = $_POST['permisos'];
                $fechaAlta = date('Y-m-d');

                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt); //siempre que haya un statement abierto hay que cerrarlo
            }
        }

        ?>
      <!-- JavaScript -->
      <script src="../bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
  </body>

  </html>