<?php
include_once 'functions.php';

class tblEntregaOntMesh{
    public function connect(){
        $obj = new Conexion();
        return $obj -> getConn();
    }
    public function disconnect(){
        $obj = new Conexion();
        return $obj->disconnected();
    }
    public function show($user){
        try {
            $con = $this->connect();
            $ps = $con->prepare("SELECT prod.prod ,om.modelo,om.serie01,om.serie02,eom.fecha_entrega, est.id as 'id_estado',est.tipo_estado, eom.fecha_liquido FROM tbl_entrega_ontmesh eom INNER JOIN tbl_ont_mesh om ON eom.id_ont_mesh_fk = om.id INNER JOIN tbl_estado est ON eom.id_estado_fk = est.id INNER JOIN tbl_ped_detall pd ON eom.id_det_fk = pd.id INNER JOIN tbl_pedido ped ON pd.id_ped_fk = ped.id INNER JOIN tbl_user u ON ped.id_user_fk = u.id INNER JOIN tbl_prod prod ON om.tipo_prod_fk = prod.id WHERE ped.id_user_fk = ?");
            $ps->bindValue(1,$user,PDO::PARAM_INT);
            $ps->execute();
            $array = array();
            while($data = $ps->fetch(PDO::FETCH_ASSOC)){
                $obj = new Entregados();
                $obj->setProd($data['prod']);
                $obj->setModelo($data['modelo']);
                $obj->setSerie01($data['serie01']);
                $obj->setSerie02($data['serie02']);
                $obj->setFechaentrega($data['fecha_entrega']);
                $obj->setIdestado($data['id_estado']);
                $obj->setEstado($data['tipo_estado']);
                $obj->setFechaliquido($data['fecha_liquido']);
                array_push($array,$obj);
            }
            $this->disconnect();
            return $array;
        } catch (Exception $e){
            var_dump($e);
        }
    }
}
?>