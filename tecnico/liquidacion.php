<?php
session_start();
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['tipo'] == 2) {
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
            <link rel="stylesheet" href="../dist/alertify/css/alertify.min.css">
            <link rel="stylesheet" href="../css/estilo.css">
            <link rel="stylesheet" href="../css/tecnico.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
            <title>Liquidacion</title>
        </head>

        <body>
            <div id="contenedor_carga">
                <div id="carga"></div>
            </div>
            <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
                <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Kardex</a>
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
                    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
                        <div class="sidebar-sticky pt-3">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="home_tecnico.php">
                                        <i class="fas fa-house-user"></i>
                                        Pedido
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">
                                        <i class="fas fa-download"></i>
                                        Liquidacion
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="cambiar_contra.php">
                                    <i class="fas fa-key"></i>
                                        Cambiar Contraseña
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </nav>
                    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                        <div class="contenedor-ped mb-4 mt-4 p-3">
                            <h4>Filtrar producto</h4>
                            <form class="form-ped p-3 mt-3">
                                <div class="row">
                                    <div class="col-6 col-sm-6 col-lg-4 col-xl-6">
                                        <label>Tipo de equipo</label>
                                        <select class="form-control slt-equipo" id="slt-equip"></select>
                                    </div>
                                    <div class="col-6 col-sm-12 col-lg-4 col-xl-6 div-btn">
                                        <button type="submit" class="btn btn-success btn-filtrar">Filtrar Producto</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <div class="contenedor-title mb-4 mt-4 p-3">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h4>Liquidacion</h4><br>
                                </div>
                                <div class="col-4 mt-2 text-center">
                                    <h5><span class="span-podruc">Fibra Optica</span> | Cantidad Disponible: <span class="span-cant">0</span></h5>
                                </div>
                                <div class="col-4">
                                    <input class="form-control" type="text" placeholder="Cantidad Liquidada">
                                </div>

                                <div class="col-4">
                                    <input class="btn btn-info btn-block" type="submit" value="Liquidar" placeholder="Cantidad Liquidada">
                                </div>
                            </div>
                        </div>

                    </main>
                </div>
            </div>
            <div class="modal fade" id="modal-alert-car" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body body-alert-car">
                            <p><i class="fas fa-exclamation-triangle fa-5x animate__animated animate__shakeY"></i></p>
                            <p class="p-aviso">Por favor, seleccione el tipo de equipo</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-msj-ped" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <h4>El pedido fue enviado con éxito</h4>
                        </div>
                    </div>
                </div>
            </div>
            <script src="../dist/js/jquery-3.6.0.js"></script>
            <script src="../dist/js/bootstrap.min.js"></script>
            <script src="../dist/datatable/datatables.js"></script>
            <script src="../dist/fontawesome/js/all.min.js"></script>
            <script src="../dist/alertify/alertify.min.js"></script>
            <script src="../js/idioma.js"></script>
            <script src="../js/tecnico.js"></script>
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