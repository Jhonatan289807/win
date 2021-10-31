<?php
session_start();
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['tipo'] == 1) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="../dist/datatable/datatables.min.css">
            <link rel="stylesheet" href="../dist/fontawesome/css/all.min.css">
            <link rel="stylesheet" href="../css/estilo.css">
            <link rel="stylesheet" href="../css/admin.css">
            <!-- 
            <link rel="stylesheet" href="../css/tecnico.css"> -->
            <title>Liquidados</title>
        </head>

        <body>
            <div id="contenedor_carga">
                <div id="carga"></div>
            </div>
            <nav class="navbar bg-dark navbar-dark sticky-top flex-md-nowrap p-0 shadow navbartitle">
                <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Kardex WIN</a>
                <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
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
                    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse siderbar-admin">
                        <div class="sidebar-sticky pt-3">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="home_admin.php">
                                        <i class="fas fa-house-user"></i>
                                        Pedidos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="abonados.php">
                                        <i class="fas fa-check-square"></i>
                                        Abonados
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="liquidados.php">
                                        <i class="fas fa-check-square"></i>
                                        Liquidados
                                    </a>
                                </li>
                                <li class="nav-item despe">
                                    <a class="nav-link" href="#">
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
                        <div class="info-titu p-3 mt-3">
                            <div class="row">
                                <div class="col-12">
                                    <h4>Filtrar Consumo</h4>
                                    <form class="form-ped p-3 mt-3">
                                        <div class="row">
                                            <div class="col-6 col-sm-6 col-lg-4 col-xl-4">
                                                <label>Tipo de equipo</label>
                                                <select class="form-control slt-equipo" id="slt-tipo"></select>
                                            </div>
                                            <div class="col-6 col-sm-6 col-lg-4 col-xl-4">
                                                <label for="">Tecnico</label>
                                                <select class="form-control slt-equipo" id="slt-tecnico"></select>
                                            </div>
                                            <div class="col-12 col-sm-12 col-lg-4 col-xl-4 div-btn">
                                                <button type="submit" class="btn btn-success btn-filtrarcon">Filtrar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="info-titu p-3 mt-3">
                            <div class="row">
                                <div class="col-3">
                                    <h5>ONT Liquidado: <span class="span-cant">0</span></h5>
                                </div>
                                <div class="col-3">
                                    <h5>ONT Restantes: <span class="span-cant">0</span></h5>
                                </div>
                                <div class="col-3">
                                    <h5>MESH Liquidado: <span class="span-cant">0</span></h5>
                                </div>
                                <div class="col-3">
                                    <h5>MESH Restantes: <span class="span-cant">0</span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="info-titu p-3 mt-3">
                            <div class="table-responsive table-ped p-3 mb-4">
                                <table class="table table-striped table-sm  text-center" id="tbl-ped">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Producto</th>
                                            <th>Modelo</th>
                                            <th>Serie 1</th>
                                            <th>Serie 2</th>
                                            <th>Fecha de Entrega</th>
                                            <th>Fecha Liquidada</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <div class="info-titu p-3 mt-3">
                            <div class="row">
                                <div class="col-12">
                                    <h5><span class="span-podruc">Fibra Optica</span> | Cantidad Disponible: <span class="span-cant">0</span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="info-titu p-3 mt-3">
                            <div class="table-responsive table-ped p-3 mb-4">
                                <table class="table table-striped table-sm  text-center" id="tbl-ped">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Producto</th>
                                            <th>Fecha Liquidada</th>
                                            <th>Cantidad Liquidada</th>
                                            <th>Cantidad Restante</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </main>
                </div>

            </div>
            <script src="../dist/js/jquery-3.6.0.js"></script>
            <script src="../dist/js/bootstrap.min.js"></script>
            <script src="../dist/datatable/datatables.js"></script>
            <script src="../dist/fontawesome/js/all.min.js"></script>
            <script src="../js/idioma.js"></script>
            <script src="../js/nav.js"></script>
            <script src="../js/liquidados.js"></script>
        </body>

        </html>
<?php
    } else {
        header("location: index.php");
    }
} else {
    header("location: index.php");
}
?>