<?php
include_once 'functions.php';

class AgregarPedidos{
	public function connect(){
        $obj = new Conexion();
        return $obj -> getConn();
    }
    public function disconnect(){
        $obj = new Conexion();
        return $obj->disconnected();
    }
    public function agregarSinONTMESH($equipo){
        try {
            $fecha = date('Y-m-d');
            $con = $this->connect();
            foreach($equipo as $ped){
                if($ped['tipo'] != 1 && $ped['tipo'] != 2){
                    $ps = $con->prepare("INSERT INTO tbl_entrega_otros (id_det_fk,fecha_entrega,cant_liquido,fecha_liquido) VALUES (?,?,?,?)");
                    $ps->bindValue(1,$ped['iddet'],PDO::PARAM_INT);
                    $ps->bindValue(2,$fecha);
                    $ps->bindValue(3,0,PDO::PARAM_INT);
                    $ps->bindValue(4,'0-0-0');
                    $ps->execute();
                }
            } 
            $this->disconnect();
        } catch (Exception $e) {
            return $e;
        }
    }
    public function agregarONTMESH($ontmesh){
        try {
            $fecha = date('Y-m-d');
            $con = $this->connect();
            foreach($ontmesh as $ped){
                $ps = $con->prepare("INSERT INTO tbl_entrega_ontmesh (id_det_fk,id_ont_mesh_fk,fecha_entrega,id_estado_fk,fecha_liquido) VALUES (?,?,?,?,?)");
                $ps->bindValue(1,$ped['iddet'],PDO::PARAM_INT);
                $ps->bindValue(2,$ped['id'],PDO::PARAM_INT);
                $ps->bindValue(3,$fecha);
                $ps->bindValue(4,5,PDO::PARAM_INT);
                $ps->bindValue(5,'0-0-0');
                $ps->execute();
            }
            $this->disconnect();
        } catch  (Exception $e) {
            return $e;
        }
    }
    public function ontMeshEntregados($id){
        try {
            $con = $this->connect();
            $ps = $con->prepare("SELECT eom.id,pr.prod,om.modelo,om.serie01,om.serie02,eom.fecha_entrega FROM tbl_pedido ped INNER JOIN tbl_ped_detall det ON ped.id = det.id_ped_fk INNER JOIN tbl_entrega_ontmesh eom ON det.id = eom.id_det_fk INNER JOIN tbl_ont_mesh om ON om.id = eom.id_ont_mesh_fk INNER JOIN tbl_prod pr ON om.tipo_prod_fk = pr.id WHERE ped.id = ? ORDER BY pr.prod");
            $ps->bindValue(1,$id,PDO::PARAM_INT);
            $ps->execute();
            $array = array();
            while($data = $ps->fetch(PDO::FETCH_ASSOC)){
                $obj = new Entregados();
                $obj->setId($data['id']);
                $obj->setProd($data['prod']);
                $obj->setModelo($data['modelo']);
                $obj->setSerie01($data['serie01']);
                $obj->setSerie02($data['serie02']);
                $obj->setFechaentrega($data['fecha_entrega']);
                array_push($array,$obj);
            }
            $this->disconnect();
            return $array;
        } catch (Exception $e) {
            var_dump($e);
        }
    }
    public function otrosEntregados($id){
        try {
            $con = $this->connect();
            $ps = $con->prepare("SELECT eo.id, pr.prod, det.cantidad,eo.fecha_entrega FROM tbl_entrega_otros eo INNER JOIN tbl_ped_detall det ON eo.id_det_fk = det.id INNER JOIN tbl_pedido ped ON det.id_ped_fk = ped.id INNER JOIN tbl_prod pr ON det.tipo_prod_fk = pr.id WHERE ped.id = ?");
            $ps->bindValue(1,$id,PDO::PARAM_INT);
            $ps->execute();
            $array = array();
            while($data = $ps->fetch(PDO::FETCH_ASSOC)){
                $obj = new Entregados();
                $obj->setId($data['id']);
                $obj->setProd($data['prod']);
                $obj->setCantidad($data['cantidad']);
                $obj->setFechaentrega($data['fecha_entrega']);
                array_push($array,$obj);
            }
            $this->disconnect();
            return $array;
        } catch (Exception $e) {
            var_dump($e);
        }
    }
}
?>