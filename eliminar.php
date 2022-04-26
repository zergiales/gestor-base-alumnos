<html>
<?php
session_start();
include_once 'header.php';
?>

<head>
    <title>Eliminar</title>
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

        .menu {
            margin-bottom: -50px;
        }
    </style>
</head>
<?php
menu(); //funcion para mostrar el menu 
deleteAlumno(); //funcion para mmostrar el menu desde donde empezamos a borrar el alumnos que le pasemos su id
if (isset($_POST['eliminar'])) { ?> <script>
        console.log("entra en eliminar");
    </script><?php
                $id = $_POST['clave']; //id del alumnos a borrar
                $con = mysqli_connect(host, user, pass) or die("No se ha podido conectar al servidor de Base de datos"); //control de errores al servidor de base de datos
                $db = mysqli_select_db($con, 'escuela') or die("no se ha podido conectar a la base de datos"); //control de errores a la base de datos
                $consulta = "DELETE FROM alumnos WHERE id='$id'";
                echo $consulta; //consulta que en base al id que le pasemos borrar una cosa u otra
                $resultado = mysqli_query($con, $consulta) or die("error en la consulta");
                if ($resultado) {
                ?><script>
            alert("se ha eliminado correctamente");
        </script><?php
                } else {
                    ?><script>
            alert("no se eliminado correctamente");
        </script><?php
                }
            }
            function deleteAlumno()
            {
                if (!isset($_POST['siguiente'])) {
                    ?>
        <div class="container h-75 ">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                        <p class="display-6">Eliminar alumnos</p>
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Realice la busqueda</h1>
                            <form action="eliminar.php" method="POST" class="needs-validation" autocomplete="off">
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="nombre">Nombre</label>
                                    <input id="nombre" type="text" class="form-control" name="nombre" autofocus>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="nombre">Apellido</label>
                                    <input id="apellidos" type="text" class="form-control" name="apellidos" autofocus>
                                </div>
                                <input onclick="return fcomprobar()" type="submit" class="btn btn-primary ms-auto" name="siguiente" value="siguiente">

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

                if (isset($_POST['siguiente'])) {

                    //LLAMAMOS QUE NOS MUESTRETODOS LOS USUARIOS ROLLO CONSULTAR YLO S METEMOS EN INPUTS SUS VALORES 
                    //DESPUES COMBINAMOS EL INSERTAR PARA QUE CUANDO CAMBIEOS LOS VALORES DE LOS INPUT NOS DEJE Y EN VERZ DE HACER UN ALET TABLE , +
                    //HACEMOS UN INSER  INTO
                    $con = mysqli_connect(host, user, pass) or die("No se ha podido conectar al servidor de Base de datos");
                    $db = mysqli_select_db($con, 'escuela') or die("no se ha podido conectar a la base de datos");
                    $nombre = $_POST['nombre'];
                    $apellidos = $_POST['apellidos'];
                    $consulta = "SELECT * FROM alumnos WHERE nombre LIKE '%$nombre%' and apellidos LIKE '%$apellidos%'";
                    echo $consulta;
                    $resultado = mysqli_query($con, $consulta) or die("error en la consulta");
                    // Motrar el resultado de los registro de la base de datos
                    // Bucle while que recorre cada registro y muestra cada campo en la tabla.
    ?>
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

                    while ($columna = mysqli_fetch_row($resultado)) {
            ?>
                <form action="eliminar.php" method="post">';
                    <tbody>
                        <tr>
                            <td><input type="text" disabled name="id" id="id" value="<?= $columna[0] ?>"></td>
                            <td><input type="text" disabled name="nombre" id="nombre" value="<?= $columna[1] ?>"></td>
                            <td><input type="text" disabled name="apellidos" id="apellidos" value="<?= $columna[2] ?>"></td>
                            <td><input type="text" disabled name="dni" id="dni" value="<?= $columna[3] ?>"></td>
                            <td><input type="text" disabled name="fechaNacimiento" id="fechaNacimiento" value="<?= $columna[4] ?>"></td>
                            <td><input type="text" disabled name="idTipoVia" id="idTipoVia" value="<?= $columna[5] ?>"></td>
                            <td><input type="text" disabled name="nombreVia" id="nombreVia" value="<?= $columna[6] ?>"></td>
                            <td><input type="text" disabled name="numeroVia" id="numeroVia" value="<?= $columna[7] ?>"></td>
                            <td><input type="text" disabled name="localidad" id="localidad" value="<?= $columna[8] ?>"></td>
                            <td><input type="text" disabled name="telefono" id="telefono" value="<?= $columna[9] ?>"></td>
                            <!--pasamos el id de los alumnos cuando le demos a eliminar-->
                            <td><input type="hidden" name="clave" id="clave" value="<?= $columna[0] ?>"></td>
                            <td><input type="submit" name="eliminar" value="eliminar" class="btn btn-primary ms-auto"></td>
                        </tr>
                </form>
            <?php
                    }
            ?>
            </tbody>
        </table>
<?php
                }
            }
?>
<!-- JavaScript -->
<script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>