<html>

<head>
    <title>Inicio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <!--hoja de estilos para el menu-->
    <link href="assets/css/menu.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    include_once 'dbconf.php'; //para la conexion con la base de datos 
    include_once 'header.php'; //para llamar a las funciones de los menus de admin y visor
    //INICIO DE SESION
    /*anotacion:ponemos post en vez de session para que luego desaparezcan las cosas de la pagina */
    if (!isset($_POST['comenzar'])) {
    ?>
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                        <p class="display-6">Bienvenido</p>
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Inicio de sesion</h1>
                            <!--formulario que recoge los datos-->
                            <form action="index.php" method="POST" class="needs-validation" autocomplete="off">
                                <!--Donde metemos el usuario-->
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="usuario">Usuario</label>
                                    <input id="text" type="text" class="form-control" name="usuario" value="" required autofocus>
                                </div>
                                <!--donde metemos la contraseña-->
                                <div class="mb-3">
                                    <div class="mb-2 w-100">
                                        <label class="text-muted" for="password">Contraseña</label>
                                        <!--por si se te olvida [DECORACION*]-->
                                        <a href="funciones/olvidar.html"" class=" float-end">¿olvidaste la contraseña?</a>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                                <!--más decoracion-->
                                <div class="d-flex align-items-center">
                                    <div class="form-check">
                                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                        <label for="remember" class="form-check-label">¿recordar contraseña?</label>
                                    </div>
                                    <button type="submit" value="comenzar" name="comenzar" class="btn btn-primary ms-auto" onclick="return fcomprobar()">comenzar</button>
                                    <!--Cuando pulsamos el boton,activamos una funcion de javascript que valida si se rellenan los campos-->
                                </div>
                            </form>
                        </div>
                        <div class="card-footer py-3 border-0">
                            <div class="text-center">
                                <!--nos envia a un formulario para crear un usuario si no tenemos creado ya uno-->
                                ¿No estas registrado aun? <a href="funciones/insertarUsuario.php" class="text-dark">Registrate</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-5 text-muted">
                        Menu realizado con php , css3 , html, javaScript y Bootsrap
                    </div>
                </div>
            </div>
        </div>
        <script src="../bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
    <?php
    }
    //si existe metemos el usuario en una sesion
    if (isset($_POST['comenzar'])) {
        $_SESSION['usuario'] = $_POST['usuario'];
        $_SESSION['password'] = $_POST['password'];
        comprobar(); //llamamos a la funcion que comprueba si el usuario existe en la base datos y coincide
    }
    ?>
    <script>
        //funcion de javaScript que  lo que haces es que si no metes un user y una password no te deja empezar
        function fcomprobar() {
            if (document.getElementById("user").value == "" || document.getElementById("password").value == "") {
                alert("inserte un usuario y contraseña");
                return false;
            }
        }
    </script>
    <?php
    //COMPROBACION
    function comprobar()
    {
        $usuario = $_SESSION['usuario']; //usuario recogido del primer formulario
        $contraseña = $_SESSION['password']; //contraseña recogida del primer formulario
        // var_dump($usuario);
        // var_dump($contraseña);
        include_once('dbconf.php'); //llamamos a las contantes de las bases de datos (host,user,pass)
        /*or die => con esto controlamos los errores si los hubiese, nos muestra por pantalla un mensaje diciendonos que hay un error */
        $con = mysqli_connect(host, user, pass) or die("No se ha podido conectar al servidor de Base de datos"); //conexion con el servidor que tiene la base de datos
        $db = mysqli_select_db($con, 'escuela') or die("no se ha podido conectar a la base de datos"); //conexion con la base de datos
        $consulta = "SELECT * FROM usuarios WHERE usuario='$usuario'"; //consulta le pasamos como parametro el usuario y la contraseña
        $resultado = mysqli_query($con, $consulta) or die("error en la consulta"); //resultado de la consulta sql rrealizada
        $filas = mysqli_num_rows($resultado); //fila de la tabla donde estan los datos del usuario
        //sacamos los permisos
        $campo = mysqli_fetch_assoc($resultado); //para sacar los datos del campo de permisos para diferenciar entre visor y admin
        @$_SESSION['permisos'] = $campo['permisos']; //metemos en una sesion los permisos para mas adelante mostrarlo
        if (@password_verify($contraseña, $campo['password']) === true) { //para verificar la contraseña que metemos en login con la cifrada en la base de datps
            # code...
            //var_dump($campo['permisos']);
            //filas devuelve un valor de 1 o 0 (1= correcto & 0=incorrecto)
            if ($filas) {
                //aquí elegimos si mostrar un menu u otro
                switch ($campo['permisos']) {
                    case 'admin':
    ?> <script>
                            alert("bienvenido")
                        </script><?php
                                    menu(); //funcion de header.php
                                    break;
                                case 'visor':
                                    ?> <script>
                            alert("bienvenido")
                        </script><?php

                                    menu(); //funciones de la header.php
                                    break;
                                default:
                                    break;
                            }
                        }
                    } else {
                                    ?><script>
                alert("campos incorrectos");
            </script>
            <!--FORMULARIO DE INICIO DE SESION SI NO ES CORRECTO-->
            <div class="container h-100">
                <div class="row justify-content-sm-center h-100">
                    <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                        <div class="text-center my-5">
                            <p class="display-6">Bienvenido</p>
                        </div>
                        <div class="card shadow-lg">
                            <div class="card-body p-5">
                                <h1 class="fs-4 card-title fw-bold mb-4">Inicio de sesion</h1>
                                <form action="index.php" method="POST" class="needs-validation" autocomplete="off">
                                    <div class="mb-3">
                                        <label class="mb-2 text-muted" for="usuario">Usuario</label>
                                        <input id="text" type="text" class="form-control" name="usuario" value="" required autofocus>
                                    </div>

                                    <div class="mb-3">
                                        <div class="mb-2 w-100">
                                            <label class="text-muted" for="password">Contraseña</label>
                                            <a href="funciones/olvidar.html" class="float-end">
                                                ¿olvidaste la contraseña?
                                            </a>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" required>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="form-check">
                                            <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                            <label for="remember" class="form-check-label">Recordar contraseña</label>
                                        </div>
                                        <button type="submit" value="comenzar" name="comenzar" class="btn btn-primary ms-auto" onclick="return fcomprobar()">comenzar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer py-3 border-0">
                                <div class="text-center">
                                    ¿No estas registrado aun? <a href="funciones/insertarUsuario.php" class="text-dark">Registrate</a>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-5 text-muted">
                            Menu realizado con php , css3 , html, javaScript y Bootsrap
                        </div>
                    </div>
                </div>
            </div>
            <script src="../bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
    <?php }
                    mysqli_free_result($resultado);
                    mysqli_close($con);
                }
    ?>
    <!-- JavaScript -->
    <script src="assets/js/login.js"></script>
    <script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>