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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <title>Pedidos</title>
</head>

<body>
    <div id="contenedor_carga">
        <div id="carga"></div>
    </div>
    <nav class="navbar bg-dark navbar-dark sticky-top flex-md-nowrap p-0 shadow navbartitle">
        <a class="navbar-brand col-6 mr-0" href="#">Kardex WIN</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav col-6 text-right">
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
                            <a class="nav-link active" href="#">
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
                <div class="table-responsive contenedor-tablaped p-3 mt-3">
                    <h2 class="titulo-ped-det">Pedidos</h2>
                    <table class="table table-sm text-center" id="tabla-pedido">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Nº Pedido</th>
                                <th>Tecnico</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Estado</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="titulo-detalles pr-3 pl-3 pt-1 pb-2 mt-3">
                    <div class="mb-4">
                        <h3 class="titulo-ped-det">
                            <a hrf="#" class="mostrar-ped">
                                <i class="fas fa-arrow-alt-circle-left"></i>
                            </a> Información del pedido
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-6 col-sm-6 col-lg-3 col-xl-3">N°PEDIDO: <span class="span-pedido"></span></div>
                        <div class="col-6 col-sm-6 col-lg-3 col-xl-3">TÉCNICO: <span class="span-tecnico"></span></div>
                        <div class="col-6 col-sm-6 col-lg-3 col-xl-3">FECHA: <span class="span-fecha"></span></div>
                        <div class="col-6 col-sm-6 col-lg-3 col-xl-3">
                            <button class="btn btn-enviarped">
                                Enviar pedido
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive cont-detalles p-3 mt-3">
                    <h3 class="mb-4"><i class="fas fa-clipboard-list"></i> Detalles del pedido</h3>
                    <table class="table table-sm text-center" id="tabla-detalles">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Nº</th>
                                <th>Componente</th>
                                <th>Cantidad</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <div class="modal fade" id="modal-ontmesh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ontmsh-label"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm text-center" id="tabla-ontmesh">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>Nº</th>
                                    <th>SERIE 1</th>
                                    <th>SERIE 2</th>
                                    <th>MODELO</th>
                                    <th>ACCIÓN</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <hr>
                    </hr>
                    <div class="table-responsive">
                        <label class="titulo-detalles" for="">Equipos agregados</label><br>
                        <span class="span-aviso">AVISO: Alcanzó la cantidad máxima de equipos pedidos</span>
                        <table class="table table-sm text-center" id="tabla-car">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>Nº</th>
                                    <th>SERIE 1</th>
                                    <th>SERIE 2</th>
                                    <th>MODELO</th>
                                    <th>ACCIÓN</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-msj-ped" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center modal-body-cont">
                    <i class="far fa-check-circle fa-7x animate__animated animate__bounceIn"></i>
                    <h4>Se entregó con éxito</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-alert-car" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body body-alert-car">
                    <p><i class="fas fa-exclamation-triangle fa-5x animate__animated animate__shakeY"></i></p>
                    <p class="p-aviso">Todavía no ha seleccionado ningún equipo</p>
                </div>
            </div>
        </div>
    </div>
    <script src="../dist/js/jquery-3.6.0.js"></script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <script src="../dist/datatable/datatables.js"></script>
    <script src="../dist/fontawesome/js/all.min.js"></script>
    <script src="../js/nav.js"></script>
    <script src="../js/idioma.js"></script>
    <script src="../js/admin.js"></script>
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