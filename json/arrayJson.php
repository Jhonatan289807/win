<?php
function jsonUser($obj){
    try {
        return array(
            'id'    => $obj->getId(),
            'cod'   => $obj->getUsercod(),
            'cel'   => $obj->getUserphone(),
            'tipo'  => $obj->getTypeuser()
        );
    } catch (Exception $e) {
        return array('ocurrio un error en el json');
    }
}
function jsonPedidos($obj){
    try {
        return array(
            'idped'     => $obj->getIdped(),
            'iduser'    => $obj->getIduser(),
            'user'      => $obj->getUser(),
            'fecha'     => $obj->getFecha(),
            'hora'      => $obj->getHora(),
            'idest'     => $obj->getIdestado(),
            'est'       => $obj->getEstado()
        );
    } catch (Exception $e) {
        return array('ocurrio un error en el json');
    }
}
function jsonPedDetalle($obj){
    try {
        return array(
            'iddet'     => $obj->getIddet(),
            'idped'     => $obj->getIdped(),
            'tipo'      => $obj->getTipoprod(),
            'prod'      => $obj->getProd(),
            'cantidad'  => $obj->getCantidad()
        );
    } catch (Exception $e) {
        return array('ocurrio un error en el json');
    }
}
function jsonOntMeshDisp($obj){
    try {
        return array(
            'id'      => $obj->getId(),
            'tipo'    => $obj->getTipo(),
            'serie01' => $obj->getSerie01(),
            'serie02' => $obj->getSerie02(),
            'modelo'  => $obj->getModelo()
        );
    } catch (Exception $e) {
        return array('ocurrio un error en el json');
    }
}
function jsonOntMesh($obj){
    try {
        return array(
            'id'       => $obj->getId(),
            'tipo'     => $obj->getTipo(),
            's01'      => $obj->getSerie01(),
            's02'      => $obj->getSerie02(),
            'modelo'   => $obj->getModelo(),
            'idestado' => $obj->getIdestado(),
            'estado'   => $obj->getEstado() 
        );
    } catch (Exception $e) {
        return array('ocurrio un error en el json');
    }
}
function jsonCarONTMESH($datos){
    try {
        return array(
            'iddet'   => $datos[0],
            'id'      => $datos[1],
            'tipo'    => $datos[2],
            'serie01' => $datos[3],
            'serie02' => $datos[4],
            'modelo'  => $datos[5]
        );
    } catch (Exception $e) {
        return array('ocurrio un error en el json');
    }
}
function jsonPedEntrega($obj){
    try {
        return array(
            'iddet'   => $obj->getIddet(),
            'tipo' => $obj->getTipoprod(),
            'cant' => $obj->getCantidad()
        );
    } catch (Exception $e) {
        return array('ocurrio un error en el json');
    }
}
function jsonProductos($obj){
    try {
        return array(
            'idprod' => $obj->getIdprod(),
            'prod'   => $obj->getProd(),
            'cant'   => $obj->getCant()
        );
    } catch (Exception $e) {
        return array('ocurrio un error en el json');
    }
}
function jsonPedEntregados($obj){
    try {
        return array(
            'idped' => $obj->getIdped(),
            'tecnico' => $obj->getUser(),
            'fecha' => $obj->getFecha(),
            'hora' => $obj->getHora()
        );
    } catch (Exception $e) {
        return array('ocurrio un error en el json');
    }
}
function jsonOntMeshEntregados($obj){
    try {
        return array(
            'id' => $obj->getId(),
            'prod' => $obj->getProd(),
            'modelo' => $obj->getModelo(),
            'serie01' => $obj->getSerie01(),
            'serie02' => $obj->getSerie02(),
            'fecha_ent' => $obj->getFechaentrega()
        );
    } catch (Exception $e) {
        return array('ocurrio un error en el json');
    }
}
function jsonOtrosEntregados($obj){
    try {
        return array(
            'id' => $obj->getId(),
            'prod' => $obj->getProd(),
            'cant' => $obj->getCantidad(),
            'fecha_ent' => $obj->getFechaentrega()
        );
    } catch (Exception $e) {
        return array('ocurrio un error en el json');
    }
}
function jsonSelectProd($obj){
    try {
        return array(
            'id' => $obj->getIdprod(),
            'prod' => $obj->getProd()
        );
    } catch (Exception $e) {
        return array('ocurrio un error en el json');
    }
}
function jsonSelectTec($obj){
    try {
        return array(
            'id' => $obj->getId(),
            'user' => $obj->getUser()
        );
    } catch (Exception $e) {
        return array('ocurrio un error en el json');
    }
}
function jsonEquiposOntMesh($obj){
    try {
        return array(
            'prod' => $obj->getProd(),
            'modelo' => $obj->getModelo(),
            'serie01' => $obj->getSerie01(),
            'serie02' => $obj->getSerie02(),
            'fecha_entrega' => $obj->getFechaentrega(),
            'id_estado' => $obj->getIdestado(),
            'estado' => $obj->getEstado(),
            'fecha_liquido' => $obj->getFechaliquido()
        );
    } catch (Exception $e) {
        return array('ocurrio un error en el json');
    }
}
function jsonUsersAdmin($obj){
    try {
        return array(
            'user' => $obj->getUser(),
            'cod'  => $obj->getUsercod(),
            'cel'  => $obj->getUserphone()
        );
    } catch (Exception $e) {
        return array('ocurrio un error en el json');
    }
}
?>