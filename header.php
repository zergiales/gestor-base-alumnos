<?php
include_once('dbconf.php');
//sacamos los permisos

function menu()
{
?>
    <div class='dashboard'>
        <div class="dashboard-nav">
            <header><a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a><a href="#" class="brand-logo"><i class="fas fa-anchor"></i> <span>GESTOR DE BD</span></a></header>
            <nav class="dashboard-nav-list">
                <!--menu para acceder a todas las opciones-->
                <a href="añadir.php" class="dashboard-nav-item nav-link <?php if ($_SESSION['permisos'] != 'admin') echo 'disabled' ?> ">Insertar alumnos </a>
                <a href="modificar.php" class="dashboard-nav-item nav-link <?php if ($_SESSION['permisos'] != 'admin') echo 'disabled' ?>"> Modificar alumnos</a>
                <a href="eliminar.php" class="dashboard-nav-item nav-link <?php if ($_SESSION['permisos'] != 'admin') echo 'disabled' ?>"> Eliminar alumnos</a>
                <a href="consultar.php" class="dashboard-nav-item "><i class="fas fa-file-upload"></i> Consultar alumnos</a>
                <!--si el valor de la sesion es visor,descativamos el resto de opciones-->
                <div class="nav-item-divider"></div>
                <a href="index.php" class="dashboard-nav-item pl-5"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                    </svg> Cerrar Sesion </a>
            </nav>
        </div>
        <div class='dashboard-app'>
            <header class='dashboard-toolbar'><a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a></header>
            <div class='dashboard-content'>
                <div class='container'>
                    <div class='card'>
                        <div class='card-header'>
                            <h1>Bienvenido <?php echo $_SESSION['usuario'] ?> </h1>
                        </div>
                        <div class='card-body'>
                            <h2>Su cuenta tiene permisos de :
                                <?php echo $_SESSION['permisos'];?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/menu.js"></script>
<?php
}
