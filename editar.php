<html>

<head>
    <title>Registrar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <!--hoja de estilos para el menu-->
    <link href="assets/css/menu.css" rel="stylesheet">
    <style>
        .modificar {
            margin-top: -20%;
            margin-left: 20%;
        }

        .modificar input {

            width: 100px;
            height: 30px;
        }
    </style>
</head>
<header>
    <?php
    session_start();//inicio de la sesion para el id que guardaremos en una sesion 
    include_once 'header.php';
    menu();
    ?>
</header>

<body>
    <?php
    modAlumno();//llamada a la funcion 
    //funcion que llamamos para decirle que nos muestre la fila que queremos editar
    function modAlumno()
    {
        if (isset($_GET["id"])) {
            $_SESSION['id'] = $_GET["id"]; //con esto recibimos valores a traves del url
        }
        $id = $_SESSION['id']; //lo metemos en una sesion para no perderlo
        $con = mysqli_connect(host, user, pass) or die("No se ha podido conectar al servidor de Base de datos");
        $db = mysqli_select_db($con, 'escuela') or die("no se ha podido conectar a la base de datos");
        $alumnos = "SELECT * FROM alumnos WHERE id='$id'";
        $resultado = mysqli_query($con, $alumnos) or die("error en la consulta");
    ?>
        <div class="container d-flex justify-content-center">
            <table border="2" class="modificar">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>dni</th>
                        <th>nacimiento</th>
                        <th>via</th>
                        <th>nombre via</th>
                        <th>nº via</th>
                        <th>localidad</th>
                        <th>telefono</th>
                    </tr>
                </thead>
                <?php
                //bucle while qu enos muestra una serie de formularios desactivados donde muestramos todos los datos
                echo '<form action="editar.php" method="POST">';
                while ($columna = mysqli_fetch_row($resultado)) {
                ?>
                    <tbody>
                        <tr class="">
                            <!--el id no lo dejamos editar ,porque es unico-->
                            <td><input type="text" disabled name="id" id="id" value="<?= $columna[0] ?>" class=""></td>
                            <td><input type="text" name="nombre" id="nombre" value="<?= $columna[1] ?>"></td>
                            <td><input type="text" name="apellidos" id="apellidos" value="<?= $columna[2] ?>"></td>
                            <td><input type="text" name="dni" id="dni" value="<?= $columna[3] ?>"></td>
                            <td><input type="text" name="fechaNacimiento" id="fechaNacimiento" value="<?= $columna[4] ?>"></td>
                            <td><input type="text" name="idTipoVia" id="idTipoVia" value="<?= $columna[5] ?>"></td>
                            <td><input type="text" name="nombreVia" id="nombreVia" value="<?= $columna[6] ?>"></td>
                            <td><input type="text" name="numeroVia" id="numeroVia" value="<?= $columna[7] ?>"></td>
                            <td><input type="text" name="localidad" id="localidad" value="<?= $columna[8] ?>"></td>
                            <td><input type="text" name="telefono" id="telefono" value="<?= $columna[9] ?>"></td>
                            <td><input type="hidden" name="clave" id="clave" value="<?= $columna[0] ?>"></td>
                            <td><input type="submit" name="modificar" value="modificar"></td>
                            <!--pasamos el id de los alumnos cuando le demos a editar-->
                        </tr>
                    <?php
                }
                    ?>
                    </tbody>
            </table>
        </div>
        <?php
        mysqli_close($con);
    }


    if (isset($_POST['modificar'])) {
        $id = $_POST['clave'];
        //metemos los valores del post en variables para luego en la consulta actualizar los datos
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $dni = $_POST['dni'];
        $fechaNacimiento = $_POST['fechaNacimiento'];
        $idTipoVia = $_POST['idTipoVia'];
        $nombreVia = $_POST['nombreVia'];
        $numeroVia = $_POST['numeroVia'];
        $localidad = $_POST['localidad'];
        $telefono = $_POST['telefono'];

        $con = mysqli_connect(host, user, pass) or die("No se ha podido conectar al servidor de Base de datos");
        $db = mysqli_select_db($con, 'escuela') or die("no se ha podido conectar a la base de datos");
        //para actualizar los datos de la tabla alumnos 
        $consulta = "UPDATE alumnos SET nombre='$nombre',apellidos='$apellidos',
        fechaNacimiento='$fechaNacimiento',idTipoVia='$idTipoVia',nombreVia='$nombreVia',numeroVia='$numeroVia',localidad='$localidad',
        telefono='$telefono' WHERE id='$id'";

        $resultado = mysqli_query($con, $consulta);//para la ejecucion de la 
        if ($resultado) {
            unset($_SESSION);//cierre de la sesiones 
        ?>
            <script>
                alert("se han guardado correctamente");
                window.location = "modificar.php";//redireciona a que modifiques de nuevo 
            </script>
        <?php
        } else {
        ?>
            <script>
                alert("no se han guardado correctamente");
                window.history.go(-1);
            </script>
    <?php

        }
    }
    ?>
</body>