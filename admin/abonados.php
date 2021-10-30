<?php
session_start();
if(isset($_SESSION['user'])){
    if($_SESSION['user']['tipo'] == 1){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../dist/datatable/datatables.min.css">
    <link rel="stylesheet" href="../dist/datatable/datatables.css">
    <link rel="stylesheet" href="../dist/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Abonados</title>
</head>

<body>
    <div id="contenedor_carga">
        <div id="carga"></div>
    </div>
    <nav class="navbar bg-dark navbar-dark sticky-top flex-md-nowrap p-0 shadow navbartitle">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Kardex WIN</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link btn-cerrar" href="#">Cerrar sesión</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse siderbar-admin">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="home_admin.php">
                                <i class="fas fa-house-user"></i>
                                Pedidos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="abonados.php">
                                <i class="fas fa-check-square"></i>
                                Abonados
                            </a>
                        </li>
                        <li class="nav-item despe">
                            <a class="nav-link">
                                <i class="fas fa-box"></i>
                                Equipos
                                <i class="fas fa-angle-double-down"></i>
                            </a>
                            <ul class="submenu nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="equipos.php">
                                        <i class="fas fa-clipboard-list"></i>
                                        Todos
                                    </a>
                                </li>

                                <li class="nav-item">

                                    <a class="nav-link" href="ont.php">
                                        <i class="fas fa-boxes"></i>
                                        ONT
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="mesh.php">
                                        <i class="fas fa-boxes"></i>
                                        MESH
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="usuarios.php">
                                <i class="fas fa-user"></i>
                                Usuarios
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="table-responsive contenedor-tablaped mt-3 p-3">
                    <h2 class="titulo-ped-det">Pedidos entregados</h2>
                    <table class="table table-sm text-center" id="tabla-pedido">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Nº</th>
                                <th>Técnico</th>
                                <th>Fecha del pedido</th>
                                <th>Detalles</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <div class="modal fade" id="modaldetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Equipos entregados | Fecha que se entregó: <span class="span-fecha"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive contenedor-tablaontmesh">
                        <h5>ONT y MESH</h5>
                        <table class="table table-sm text-center" id="tabla-ontmesh">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>Nº</th>
                                    <th>Descripción</th>
                                    <th>Modelo</th>
                                    <th>Serie 01</th>
                                    <th>Serie 02</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="table-responsive contenedor-tablaotros">
                        <h5>Otros Equipos</h5>
                        <table class="table table-sm text-center" id="tabla-otros">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>Nº</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../dist/js/jquery-3.6.0.js"></script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <script src="../dist/datatable/datatables.js"></script>
    <script src="../dist/fontawesome/js/all.min.js"></script>
    <script src="../js/idioma.js"></script>
    <script src="../js/nav.js"></script>
    <script src="../js/abonados.js"></script>
</body>

</html>
<?php
    }else{
        header("location: index.php");
    }
}else{
    header("location: index.php");
} 
?>