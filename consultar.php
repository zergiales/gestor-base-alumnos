<html>
<?php
session_start();
include_once 'dbconf.php';//donde esta la conexion y tema de bases de dato s
include_once 'header.php';//donde esta el menu
?>

<head>
    <title>Añadir</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <!--hoja de estilos para el menu-->
    <link href="assets/css/menu.css" rel="stylesheet">
    <style>
        .form {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;

        }

        .form input {
            margin-bottom: 10px;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <?php
    menu();//llamamos a la funcion del header
    if (!isset($_POST['siguiente'])) {
    ?>
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                        <p class="display-6">Consultar alumnos</p>
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Realice la busqueda</h1>
                            <form action="consultar.php" method="POST" class="needs-validation" autocomplete="off">
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="nombre">Nombre</label>
                                    <input id="nombre" type="text" class="form-control" name="nombre" autofocus>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="nombre">Apellido</label>
                                    <input id="apellidos" type="text" class="form-control" name="apellidos" autofocus>
                                </div>
                                <input onclick="return fcomprobar()" type="submit" class="btn btn-primary ms-auto p-2" name="siguiente" value="siguiente">
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--UNA VEZ EXISTA EL POST COMENZAR LLAMAMOS A LA FUNCION DE JAVASCRIPT Y DE PHP-->
        <script>
            //funcion de javaScript que  lo que haces es que si no metes un user y una password no te deja empezar el juego  
            function fcomprobar() {
                if (document.getElementById("nombre").value == "" && document.getElementById("apellidos").value == "") {
                    alert("inserte un nombre o un apellido");
                    return false;
                }
            }
        </script>
    <?php
    }
    //Si existe el post siguiente
    if (isset($_POST['siguiente'])) {
        $nombre = $_POST['nombre'];//guardamos en variables para acceder a la consulta (no hace falta , se puede con {})
        $apellidos = $_POST['apellidos'];
        $con = mysqli_connect(host, user, pass) or die("No se ha podido conectar al servidor de Base de datos");
        $db = mysqli_select_db($con, 'escuela') or die("no se ha podido conectar a la base de datos");
        $consulta = "SELECT * FROM alumnos WHERE nombre LIKE '$nombre%' AND apellidos LIKE '%$apellidos%'";//se pone el 
        $resultado = mysqli_query($con, $consulta) or die("error en la consulta");//combina la ejecución de sentencias y el almacenamiento en buffer de conjuntos de resultados
        // Motrar el resultado de los registro de la base de datos
        // Encabezado de la tabla
        ?><table border='2'>
            <tr>
                <th>id</th>
                <th>nombre</th>
                <th>apellidos</th>
                <th>dni</th>
                <th>fechaNacimiento</th>
                <th>idTipoVia</th>
                <th>nombreVia</th>
                <th>numeroVia</th>
                <th>localidad</th>
                <th>telefono</th>
            </tr>
        <?php
        // Bucle while que recorre cada registro y muestra cada campo en la tabla para mostrar .
        while ($columna = mysqli_fetch_array($resultado)) {
            echo "<tr>
            <td>" . $columna['id'] . " </td><td>" . $columna['nombre'] . "</td><td>" . $columna['apellidos'] . "</td><td>" . $columna['dni'] . "</td><td>" . $columna['fechaNacimiento'] . "</td><td>" . $columna['idTipoVia'] . "</td><td>" . $columna['nombreVia'] . "</td><td>" . $columna['numeroVia'] . "</td><td>" .
                $columna['localidad'] . "</td><td>" . $columna['telefono'] . "</td>"
                . "</tr>";
        }
        // cerrar conexión de base de datos
        mysqli_close($con);
    }

    ?>
    <!-- JavaScript -->
    <script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>