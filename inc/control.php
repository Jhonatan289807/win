<?php
include_once 'functions.php';
include_once '../json/arrayJson.php';
$op = json_decode($_POST["op"]);
session_start();
switch($op){
    case 1:{//iniciar sesion
        try {
            $user = json_decode($_POST["user"]);
            $obj = new tblUser();
            if ($obj->validarCodigo($user[0]) == true){
                if($obj->validarPass($user) == true){
                    $data = jsonUser($obj->session_user($user[0]));
                    $_SESSION['user'] = [
                        'id'   => $data['id'],
                        'cod' => $data['cod'],
                        'cel'  => $data['cel'],
                        'tipo' => $data['tipo']
                    ];
                    if($data['tipo'] == 1){
                        echo json_encode('TU001');
                    }else if($data['tipo'] == 2){
                        echo json_encode('TU002');
                    }
                }else{
                    echo json_encode('ES002');
                }
            }else{
                echo json_encode('ES001');
            }
        } catch (Exception $e) {
            echo json_encode(array("error"=>"error de registro"),JSON_FORCE_OBJECT);
        }
        break;
    }
    case 2:{
        try {
            $obj = new TablaPedidos();
            $data = $obj->showPed();
            $json = [];
            foreach ($data as $ped) {
                $json[] = jsonPedidos($ped);
            }
            echo json_encode($json);
        } catch (\Throwable $th) {
            echo json_encode(array("error"=>"error de registro"),JSON_FORCE_OBJECT);
        }
        break;
    }
    case 3:{
        try {
            $idped = json_decode($_POST['idped']);
            $obj = new TablaPedDetalle();
            $data = $obj->pedDetalle($idped);
            $json =[];
            foreach($data as $ped){
                $json[] = jsonPedDetalle($ped);
            }
            echo json_encode($json);
        } catch (Exception $e) {
            echo json_encode(array("error"=>"error de registro"),JSON_FORCE_OBJECT);
        }
        break;
    }
    case 4:{
        try {
            $obj = new TablaOntMesh();
            $data = $obj->MostrarMeshDisp();
            $json = [];
            foreach($data as $mesh){
                $json[]=jsonOntMeshDisp($mesh);
            }
            echo json_encode($json);
        } catch(Exception $e){
            echo json_encode(array("error"=>"error de registro"),JSON_FORCE_OBJECT);
        }
        break;
    }
    case 5:{
        try {
            $obj = new TablaOntMesh();
            $data = $obj->MostrarOntDisp();
            $json = [];
            foreach($data as $ont){
                $json[]=jsonOntMeshDisp($ont);
            }
            echo json_encode($json);
        } catch(Exception $e){
            echo json_encode(array("error"=>"error de registro"),JSON_FORCE_OBJECT);
        }
        break;
    }
    case 6:{//iniciar y agregar sesion
        try {
            $sessionaux = '';
            $datos = json_decode($_POST['datos']);
            $prod = jsonCarONTMESH($datos);
            $validar = false;
            if(!isset($_SESSION['ONTMESH'])){
                $_SESSION['ONTMESH'][$prod['id']]=$prod;
            }else{
                $sessionaux = $_SESSION['ONTMESH'];
                foreach($sessionaux as &$ontmesh){
                    if($ontmesh['id'] == $prod['id']){
                        $validar = true;
                        break;
                    }
                }
            }
            if($validar){
                $_SESSION['ONTMESH'] = $sessionaux;
            }elseif(!$validar){
                $_SESSION['ONTMESH'][$prod['id']] = $prod;
            }
            echo json_encode(true);
        } catch (Exception $e){
            echo json_encode(array("error"=>"error de registro"),JSON_FORCE_OBJECT);
        }
        break;
    }
    case 7:{//eliminar elemento de sesion
        try {
            $sessionaux = $_SESSION['ONTMESH'];
            $id = json_decode($_POST['id']);
            $cont = 0;
            foreach ($sessionaux as &$ontmesh) {
                if($ontmesh['id'] == $id){
                    array_splice($sessionaux,$cont,1);
                    break;
                }
                $cont++;
            }
            $_SESSION['ONTMESH'] = $sessionaux;
            echo json_encode(true);
        } catch (Exception $e){
            echo json_encode(array("error"=>"error de registro"),JSON_FORCE_OBJECT);
        }
        break;
    }
    case 8:{//enviar session ONTMESH
        try {
            echo json_encode($_SESSION['ONTMESH']);
        } catch (Exception $e){
            echo json_encode(array("error"=>"error de registro"),JSON_FORCE_OBJECT);
        }
        break;
    }
    case 9:{//eliminar valores de session ONTMESH
        try {
            if(isset($_SESSION['ONTMESH'])){
                unset($_SESSION['ONTMESH']);
            }
        } catch (Exception $e){
            echo json_encode(array("error"=>"error de registro"),JSON_FORCE_OBJECT);
        }
        break;
    }
    case 10:{//destruir las sesiones
        session_destroy();
        echo json_encode(1);
        break;
    }
    case 11:{//enviar datos de session de usuario
        echo json_encode($_SESSION['user']);
        break;
    }
    case 12:{
        try {
            if(!isset($_SESSION['ONTMESH'])){
                echo json_encode(false);
            }else{
                $sessionaux=$_SESSION['ONTMESH'];
                $tipo = json_decode($_POST['tipo']);
                $arreglo = [];
                foreach($sessionaux as $equipo){
                    if($equipo['tipo'] == $tipo){
                        $arreglo[] = $equipo;
                    }
                }
                echo json_encode($arreglo);
            }
        } catch (\Throwable $th) {
            echo json_encode(array("error"=>"error al mostrar ONT o"),JSON_FORCE_OBJECT);
        }
        break;
    }
    case 13:{
        try {
            if(!isset($_SESSION['ONTMESH'])){
                echo json_encode(false);
            }else{
                $sessionaux=$_SESSION['ONTMESH'];
                $validar = json_decode($_POST['validar']);
                $cont = 0;
                if($validar == 1){
                    $tipo = json_decode($_POST['tipo']);
                    foreach($sessionaux as $equipo){
                        if($equipo['tipo'] == $tipo){
                            $cont++;
                        }
                    }
                    echo json_encode($cont);
                }else if($validar == 2){
                    $contOnt = 0;
                    $contMesh = 0;
                    $arreglo = array();
                    foreach($sessionaux as $equipo){
                        if($equipo['tipo'] == 1){
                            $contOnt++;
                        }else if($equipo['tipo'] == 2){
                            $contMesh++;
                        }
                    }
                    $arreglo=['ont'=> $contOnt,'mesh'=> $contMesh];
                    echo json_encode($arreglo);
                }
            }
        } catch (\Throwable $th) {
            echo json_encode(array("error"=>"error al validar la cantidad"),JSON_FORCE_OBJECT);
        }
        breaK;
    }
    case 14:{
            $id = json_decode($_POST["id"]);
            $ped = new TablaPedidos();
            $det = new TablaPedDetalle();
            $prod = new TablaProducto();
            $ap = new AgregarPedidos();
            $data = $det->pedido($id);
            $equipo = [];
            $validarontmesh = false;
            $validarotros = false;
            foreach($data as $pedido){
                if($pedido->getTipoprod() != 1 && $pedido->getTipoprod() != 2){
                    $validarotros = true;
                }
                if($pedido->getTipoprod() == 1 || $pedido->getTipoprod() == 2){
                    $validarontmesh = true;
                }
                $equipo[] = jsonPedEntrega($pedido);
            }
            if($validarotros == true){
                $ap->agregarSinONTMESH($equipo);
            }
            if($validarontmesh == true){
                if(isset($_SESSION['ONTMESH'])){
                    $ap->agregarONTMESH($_SESSION['ONTMESH']);
                    $ontmesh = new TablaOntMesh();
                    $ontmesh->actualizarEstado($_SESSION['ONTMESH']);
                }
            }
            $prod->NuevaCantProd($equipo);
            $ped->updatePed($id);
            echo json_encode(true);
        break;
    }
    case 15:{//mostrar inventario
        $obj = new TablaProducto();
        $data = $obj->mostrarProd();
        $json = [];
        foreach($data as $prod){
            $json[] = jsonProductos($prod);
        }
        echo json_encode($json);
        break;
    }
    case 16:{
        $id = json_decode($_POST['id']);
        $cant = json_decode($_POST['cant']);
        $obj = new TablaProducto();
        $obj->updateCantProd($cant,$id);
        echo json_encode(true);
        break;
    }
    case 17:{
        try {
            $data = json_decode($_POST['data']);
            $tipo = json_decode($_POST['tipo']);
            $obj = new TablaProducto();
            $ontmesh = new TablaOntMesh();
            if($tipo == 1 or $tipo ==2){
                $ontmesh->agregarONTMESH($data);
                $cant=$obj->mostrarCantidad($tipo);
                $obj->updateCantProd($cant+1,$tipo);
            }else if($tipo == 3){
                $obj->agregarOtros($data);
            }
            echo json_encode(true);
        } catch (\Throwable $th) {
            echo json_encode(array("error"=>"error al registrar elemento"),JSON_FORCE_OBJECT);
        }
        break;
    }
    case 18:{
        try {
            $data = $_POST['data'];
            $obj = new TablaProducto();
            $obj->actualizarProd($data);
            echo json_encode(true);
        } catch (Exception $e) {
            echo $e;
        }
        break;
    }
    case 19:{
        try {
            $tipo = json_decode($_POST['tipo']);
            $obj = new TablaOntMesh();
            $data = $obj->mostrarOntMesh($tipo);
            $json = [];
            foreach($data as $ontmesh){
                $json[] = jsonOntMesh($ontmesh);
            }
            echo json_encode($json);
        } catch (Exception $e) {
            echo json_encode($e);
        }
        break;
    }
    case 20:{
        try {
            $data = $_POST['data'];
            $obj = new TablaOntMesh();
            $obj->actualizar($data);
            echo json_encode(true);
        } catch (Exception $e) {
            echo $e;
        }
        break;
    }
    case 21:{
        try {
            $obj = new TablaPedidos();
            $data = $obj->pedEntregados();
            $json = [];
            foreach($data as $ped){
                $json[] = jsonPedEntregados($ped);
            }
            echo json_encode($json);
        } catch (Exception $e) {
            echo json_encode($e);
        }
        break;
    }
    case 22:{
        try {
            $id = json_decode($_POST['id']);
            $tipo = json_decode($_POST['tipo']);
            $obj = new AgregarPedidos();
            $json = [];
            if($tipo == 1){
                $data = $obj->ontMeshEntregados($id);
                foreach($data as $ped){
                    $json[] = jsonOntMeshEntregados($ped);
                }
            }else if($tipo ==2){
                $data = $obj->otrosEntregados($id);
                foreach($data as $ped){
                    $json[] = jsonOtrosEntregados($ped);
                }
            }
            echo json_encode($json);
        } catch (Exception $e) {
            echo json_encode($e);
        }
        break;
    }
    case 23:{
        try {
            $obj = new TablaProducto();
            $data = $obj->mostrarProd();
            $json = [];
            foreach($data as $prod){
                $json[] = jsonSelectProd($prod);
            }
            echo json_encode($json);
        } catch (\Throwable $th) {
            //throw $th;
        }
        break;
    }
    case 24:{
        try {
            $data = $_POST['data'];
            $validar = false;
            if(!isset($_SESSION['pedido'])){
                $_SESSION['pedido'][0] = [
                    'id' => $data['id'],
                    'prod' => $data['prod'],
                    'cant' => $data['cant']
                ];
            }else{
                $sessionaux = $_SESSION['pedido'];
                foreach($sessionaux as &$ped){
                    if($ped['id'] == $data['id']){
                        $ped['cant'] = $ped['cant']+$data['cant'];
                        $validar = true;
                        break;
                    }
                }
                if($validar){
                    $_SESSION['pedido'] = $sessionaux;
                }else{
                    $cont = count($_SESSION['pedido']);
                    $_SESSION['pedido'][$cont] = $data; 
                }
            }
            echo json_encode(true);
        } catch (\Throwable $th) {
            echo json_encode(array("error"=>"error al agregar elemento"),JSON_FORCE_OBJECT);
        }
        break;
    }
    case 25:{
        if(isset($_SESSION['pedido'])){
            echo json_encode($_SESSION['pedido']);
        }else{
            echo json_encode(false);
        }
        break;
    }
    case 26:{
        try {
            $id = json_decode($_POST['id']);
            $sessionaux = $_SESSION['pedido'];
            $cont = 0;
            foreach($sessionaux as &$ped){
                if($ped['id'] == $id){
                    array_splice($sessionaux,$cont,1);
                    break;
                }
                $cont++;
            }
            $_SESSION['pedido'] = $sessionaux;
            echo json_encode(true);
        } catch (\Throwable $th) {
            //throw $th;
        }
        break;
    }
    case 27:{
        try {
            $ped = new TablaPedidos();
            $pedido = array(
                'iduser' => $_SESSION['user']['id'],
                'fecha'  => date('Y-m-d'),
                'hora'   => date('h:i:s'),
                'estado' => 1
            );
            $ped->addPed($pedido);
            $idped = $ped->obtenerID($pedido);
            $pdetalle = new TablaPedDetalle();
            $pdetalle->addPedDetalle($idped,$_SESSION['pedido']);
            echo json_encode(true);
        } catch (\Throwable $th) {
            echo json_encode(array("error"=>"error al agregar elemento"),JSON_FORCE_OBJECT);
        }
        break;
    }
    case 28:{
        try {
            if(isset($_SESSION['pedido'])){
                var_dump("que paso aca");
                unset($_SESSION['pedido']);
            }
        } catch (\Throwable $th) {
            echo json_encode(array("error"=>"error al eliminar sesion"),JSON_FORCE_OBJECT);
        }
        break;
    }
    case 29:{//mostrar tecnico
        try {
            $obj = new tblUser();
            $data = $obj->mostrar_tecnico();
            $json = [];
            foreach($data as $tec){
                $json[] = jsonSelectTec($tec);
            }
            echo json_encode($json);
        } catch (\Throwable $th) {
            echo json_encode(array("error"=>"error al traer tecnicos"),JSON_FORCE_OBJECT);
        }
        break;
    }
    case 30:{
        try {
            $data = json_decode($_POST['equipos']);
            if($data[1] == 1 || $data[1]==2){
                $obj = new tblEntregaOntMesh();
                $response = $obj->show($data[0]);
                $json = [];
                foreach($response as $equipos){
                    $json[] = jsonEquiposOntMesh($equipos);
                }
                echo json_encode($json);
            }else{
            }
        } catch (\Throwable $th) {
            echo json_encode(array("error"=>"error al traer equipos"),JSON_FORCE_OBJECT);
        }
        break;
    }
    case 31:{
        try {
            $data = $_POST['data'];
            $obj = new tblUser();
            $codold = $obj->getCod();
            $codnew = $codold+1;
            $codigo = $obj->add_user($data,$codold);
            $obj->updateCod($codnew,$codold);
            $iduser = $obj->getIdUser($codigo);
            $objprod = new TablaProducto();
            $idprod = $objprod->getId();
            $disp = new TablaEquiposDisponibles();
            foreach($idprod as $prod){
                $disp->insertEquipoUser($iduser,$prod['id']);
            }
            return true;
        } catch (Exception $e){
            var_dump($e);
        }
    }
}
