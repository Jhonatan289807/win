<?php
include_once 'functions.php';
class TablaPedidos{
    public function connect(){
        $obj = new Conexion();
        return $obj -> getConn();
    }
    public function disconnect(){
        $obj = new Conexion();
        return $obj->disconnected();
    }
    public function showPed(){
        $con = $this->connect();
        $ps = $con->prepare("SELECT ped.id, ped.id_user_fk, u.user, ped.fecha, ped.hora, ped.id_estado_fk, est.tipo_estado  FROM tbl_pedido ped INNER JOIN tbl_estado est ON ped.id_estado_fk = est.id INNER JOIN tbl_user u ON ped.id_user_fk = u.id");
        $ps->execute();
        $array = array();
        while($data = $ps->fetch(PDO::FETCH_ASSOC)){
            $obj = new Pedidos();
            $obj->setIdped($data['id']);
            $obj->setIduser($data['id_user_fk']);
            $obj->setUser($data['user']);
            $obj->setFecha($data['fecha']);
            $obj->setHora($data['hora']);
            $obj->setIdestado($data['id_estado_fk']);
            $obj->setEstado($data['tipo_estado']);
            array_push($array,$obj);
        }
        $this->disconnect();
        return $array;
    }
    public function pedEntregados(){
        $con = $this->connect();
        $ps = $con->prepare("SELECT ped.id, u.user, ped.fecha, ped.hora FROM tbl_pedido ped INNER JOIN tbl_estado est ON ped.id_estado_fk = est.id INNER JOIN tbl_user u ON ped.id_user_fk = u.id WHERE ped.id_estado_fk = ?");
        $ps->bindValue(1,2,PDO::PARAM_INT);
        $ps->execute();
        $array = array();
        while($data = $ps->fetch(PDO::FETCH_ASSOC)){
            $obj = new Pedidos();
            $obj->setIdped($data['id']);
            $obj->setUser($data['user']);
            $obj->setFecha($data['fecha']);
            $obj->setHora($data['hora']);
            array_push($array,$obj);
        }
        $this->disconnect();
        return $array;
    }
    public function addPed($ped){
        $con = $this->connect();
        $ps = $con->prepare("INSERT INTO tbl_pedido (id_user_fk,fecha,hora,id_estado_fk) VALUES (?,?,?,?)");
        $ps->bindParam(1,$ped['iduser'],PDO::PARAM_INT);
        $ps->bindParam(2,$ped['fecha']);
        $ps->bindParam(3,$ped['hora']);
        $ps->bindParam(4,$ped['estado'],PDO::PARAM_INT);
        $ps->execute();
        $this->disconnect();
    }
    public function updatePed($ped){
        $con = $this->connect();
        $ps = $con->prepare("UPDATE tbl_pedido SET id_estado_fk = ? WHERE id = ?");
        $ps->bindValue(1,2,PDO::PARAM_INT);
        $ps->bindValue(2,$ped,PDO::PARAM_INT);
        $ps->execute();
        $this->disconnect();
    }
    public function obtenerID($ped){
        try {
            $con = $this->connect();
            $ps = $con->prepare("SELECT id FROM tbl_pedido WHERE id_user_fk = ? AND fecha = ? AND hora = ? AND id_estado_fk = ?");
            $ps->bindValue(1,$ped['iduser'],PDO::PARAM_INT);
            $ps->bindValue(2,$ped['fecha']);
            $ps->bindValue(3,$ped['hora']);
            $ps->bindValue(4,$ped['estado']);
            $ps->execute();
            $data = $ps->fetch(PDO::FETCH_ASSOC);
            $this->disconnect();
            return $data['id'];
        } catch (Exception $e) {
            var_dump($e);
        }
    }
}
?>