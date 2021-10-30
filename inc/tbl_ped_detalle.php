<?php
include_once 'functions.php';
class TablaPedDetalle{
    public function connect(){
        $obj = new Conexion();
        return $obj -> getConn();
    }
    public function disconnect(){
        $obj = new Conexion();
        return $obj->disconnected();
    }
    public function pedDetalle($idped){
        $con = $this->connect();
        $ps = $con->prepare("SELECT ped.id, ped.id_ped_fk, ped.tipo_prod_fk, prod.prod, ped.cantidad FROM tbl_ped_detall ped INNER JOIN tbl_prod prod ON ped.tipo_prod_fk = prod.id WHERE ped.id_ped_fk=?");
        $ps->bindParam(1,$idped,PDO::PARAM_INT);
        $ps->execute();
        $array = array();
        while($data = $ps->fetch(PDO::FETCH_ASSOC)){
            $obj = new PedDetalle();
            $obj->setIddet($data['id']);
            $obj->setIdped($data['id_ped_fk']);
            $obj->setTipoprod($data['tipo_prod_fk']);
            $obj->setProd($data['prod']);
            $obj->setCantidad($data['cantidad']);
            array_push($array,$obj);
        }
        $this->disconnect();
        return $array;
    }
    public function pedido($id){
        $con = $this->connect();
        $ps = $con->prepare("SELECT id,tipo_prod_fk,cantidad FROM tbl_ped_detall WHERE id_ped_fk=?");
        $ps->bindParam(1,$id,PDO::PARAM_INT);
        $ps->execute();
        $array = array();
        while($data = $ps->fetch(PDO::FETCH_ASSOC)){
            $obj = new PedDetalle();
            $obj->setIddet($data['id']);
            $obj->setTipoprod($data['tipo_prod_fk']);
            $obj->setCantidad($data['cantidad']);
            array_push($array,$obj);
        }
        return $array;
    }
    public function addPedDetalle($id,$sesion){
        try {
            $con = $this->connect();
            foreach($sesion as $ped){
                $ps = $con->prepare("INSERT INTO tbl_ped_detall (id_ped_fk,tipo_prod_fk,cantidad) VALUES(?,?,?)");
                $ps->bindValue(1,$id,PDO::PARAM_INT);
                $ps->bindValue(2,$ped['id'],PDO::PARAM_INT);
                $ps->bindValue(3,$ped['cant'],PDO::PARAM_INT);
                $ps->execute();
            }
            $this->disconnect();
        } catch (Exception $e) {
            return $e;
        }
    }
}
?>