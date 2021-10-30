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
    <link rel="stylesheet" href="../dist/alertify/css/alertify.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Inventario</title>
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
                            <a class="nav-link" href="abonados.php">
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
                                    <a class="nav-link active" href="equipos.php">
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
                <div class="cont-equipos p-3 mt-3">
                    <div class="row">
                        <div class="col-6">
                            <h3>Inventario</h3>
                        </div>
                        <div class="col-6 cont-nuevoequi"><button class="btn btn-success btn-nuevo-prod"
                                data-toggle="modal" data-target="#prodModal">Nuevo equipo</button></div>
                    </div>
                </div>
                <div class="table-responsive tabla-inv mt-3 p-3">
                    <table class="table table-sm text-center" id="tabla-inventario">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Nº</th>
                                <th>Producto</th>
                                <th>Stock</th>
                                <th></th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="prodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo equipo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><i class="fas fa-align-left"></i> Elija el tipo de
                            equipo</label>
                        <select id="slt-tipo-prod" class="form-control">
                            <option value="0">Seleccione</option>
                            <option value="1">ONT</option>
                            <option value="2">MESH</option>
                            <option value="3">Otros</option>
                        </select>
                    </div>
                    <form>
                        <div class="form-otros">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fas fa-angle-double-right"></i> Equipo</label>
                                <input type="text" class="form-control" id="txt-prod"
                                    placeholder="Ingrese nombre del producto" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fas fa-angle-double-right"></i>
                                    Cantidad</label>
                                <input type="number" class="form-control" id="txt-cant"
                                    placeholder="Designe su cantidad" required>
                            </div>
                            <button class="btn btn-primary btn-block btn-agregar" type="submit">Agregar</button>
                        </div>
                    </form>
                    <form>
                        <div class="form-ontmesh">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fas fa-angle-double-right"></i> Modelo</label>
                                <input type="text" class="form-control" id="txt-modelo"
                                    placeholder="Ingrese código de modelo" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fas fa-angle-double-right"></i> SERIE
                                    N°1</label>
                                <input type="text" class="form-control" id="txt-s01" placeholder="Ingrese primera serie"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><i class="fas fa-angle-double-right"></i> SERIE
                                    N°2</label>
                                <input type="text" class="form-control" id="txt-s02" placeholder="Ingrese segunda serie"
                                    required>
                            </div>
                            <button class="btn btn-primary btn-block btn-agregar" type="submit">Agregar</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="far fa-edit"></i> Editar equipo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><i class="fas fa-angle-double-right"></i> Equipo</label>
                            <input type="text" class="form-control" id="txt-prod-edit"
                                placeholder="Ingrese nombre del producto" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"><i class="fas fa-angle-double-right"></i> Cantidad</label>
                            <input type="text" class="form-control" id="txt-cant-edit"
                                placeholder="Ingrese nombre del producto" required>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary btn-edit">Guardar cambios</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <script src="../dist/js/jquery-3.6.0.js"></script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <script src="../dist/datatable/datatables.js"></script>
    <script src="../dist/fontawesome/js/all.min.js"></script>
    <script src="../dist/alertify/alertify.min.js"></script>
    <script src="../js/nav.js"></script>
    <script src="../js/idioma.js"></script>
    <script src="../js/equipos.js"></script>
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